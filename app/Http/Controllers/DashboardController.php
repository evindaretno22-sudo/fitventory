<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\StockHistory;
use App\Models\Aktivitas;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Data Produk & Stock
        $products = Produk::with('stock')->get()->map(function($p) {
            $modal = $p->stock ? $p->stock->harga : 0;
            $jual = $p->harga;
            $laba = $jual - $modal;
            $terjual = OrderItem::where('id_produk', $p->id)
                ->whereHas('order', function($q) {
                    $q->where('status pembayaran', 'lunas');
                })->sum('kuantitas');

            return [
                'id' => $p->id,
                'name' => $p->nama,
                'cat' => $p->kategori,
                'size' => $p->ukuran,
                'cond' => $p->kondisi,
                'brand' => $p->brand,
                'color' => $p->warna,
                'modal' => $modal,
                'jual' => $jual,
                'stock' => $p->stock ? $p->stock->kuantitas : 0,
                'loc' => $p->lokasi,
                'terjual' => $terjual,
                'laba' => $laba
            ];
        });

        // 2. Data Analytics
        $totalTerjual = $products->sum('terjual');
        $totalModal = $products->sum(function($p) { return $p['modal'] * $p['terjual']; });
        $totalPendapatan = $products->sum(function($p) { return $p['jual'] * $p['terjual']; });
        $totalProfit = $totalPendapatan - $totalModal;

        // 3. Aktivitas Terbaru
        $aktivitas = Aktivitas::orderBy('tanggal', 'desc')->take(10)->get()->map(function($a) {
            return [
                'desc' => $a->deskripsi,
                'date' => \Carbon\Carbon::parse($a->tanggal)->isoFormat('D MMMM YYYY, HH:mm'),
                'type' => $a->tipe == 'tambah' || $a->tipe == 'edit' ? 'add' : 'sell'
            ];
        });

        // 4. Riwayat Stok Masuk
        $stokMasuk = StockHistory::with(['stock.produk'])->where('tipe', 'in')->orderBy('created_at', 'desc')->get()->map(function($s) {
            return [
                'date' => $s->created_at->format('d/m/Y H:i'),
                'productName' => $s->stock && $s->stock->produk ? $s->stock->produk->nama : 'Unknown',
                'qty' => $s->kuantitas,
                'loc' => $s->stock && $s->stock->produk ? $s->stock->produk->lokasi : '-',
                'note' => $s->catatan ?? 'Stok Masuk'
            ];
        });

        // 5. Riwayat Stok Keluar
        $stokKeluar = StockHistory::with(['stock.produk'])->where('tipe', 'out')->orderBy('created_at', 'desc')->get()->map(function($s) {
            return [
                'date' => $s->created_at->format('d/m/Y H:i'),
                'productName' => $s->stock && $s->stock->produk ? $s->stock->produk->nama : 'Unknown',
                'qty' => $s->kuantitas,
                'reason' => $s->alasan ?? 'Terjual / Keluar',
                'note' => $s->catatan ?? '-'
            ];
        });

        // 6. Riwayat & Aktivitas (Full)
        $allAktivitas = Aktivitas::orderBy('tanggal', 'desc')->get();
        
        $activitySummary = [
            'added' => 0,
            'edited' => 0,
            'sold' => 0,
            'priceChanged' => 0
        ];

        $groups = [];
        \Carbon\Carbon::setLocale('id');

        foreach($allAktivitas as $act) {
            $tipe = $act->tipe;
            
            if ($tipe == 'tambah') $activitySummary['added']++;
            elseif ($tipe == 'edit') $activitySummary['edited']++;
            elseif ($tipe == 'terjual') $activitySummary['sold']++;
            elseif ($tipe == 'harga_diubah') $activitySummary['priceChanged']++;

            $carbonDate = \Carbon\Carbon::parse($act->tanggal);
            $dateStr = $carbonDate->isoFormat('dddd, D MMMM YYYY');
            $timeStr = $carbonDate->format('H:i');

            if (!isset($groups[$dateStr])) {
                $groups[$dateStr] = [];
            }

            $color = 'blue';
            $icon = 'M12 4v16m8-8H4';
            $label = 'Aktivitas';

            if ($tipe == 'tambah') {
                $color = 'blue'; $label = 'Ditambahkan';
                $icon = 'M12 4v16m8-8H4';
            } elseif ($tipe == 'edit') {
                $color = 'yellow'; $label = 'Diedit';
                $icon = 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z';
            } elseif ($tipe == 'terjual') {
                $color = 'green'; $label = 'Terjual';
                $icon = 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z';
            } elseif ($tipe == 'harga_diubah') {
                $color = 'purple'; $label = 'Harga Diubah';
                $icon = 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
            } else {
                $color = 'gray'; $label = ucfirst($tipe);
                $icon = 'M13 16h-1v-4h-1m1-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
            }

            $groups[$dateStr][] = [
                'type' => $tipe,
                'icon' => $icon,
                'color' => $color,
                'label' => $label,
                'product' => 'Sistem',
                'desc' => $act->deskripsi,
                'time' => $timeStr
            ];
        }

        $activityGroups = [];
        foreach($groups as $date => $items) {
            $activityGroups[] = [
                'date' => $date,
                'items' => $items
            ];
        }

        // 7. Data Laporan Penjualan
        $salesLogs = OrderItem::with(['produk.stock', 'order'])
            ->whereHas('order', function($q) {
                $q->where('status pembayaran', 'lunas');
            })
            ->orderBy('created_at', 'desc')
            ->get()->map(function($item) {
                $modal = $item->produk && $item->produk->stock ? $item->produk->stock->harga : 0;
                $jual = $item->harga; // Harga jual saat transaksi
                $qty = $item->kuantitas;
                $modalTotal = $modal * $qty;
                $revenueTotal = $jual * $qty;
                $profitTotal = $revenueTotal - $modalTotal;

                return [
                    'date' => $item->created_at->format('d M Y H:i'),
                    'productName' => $item->produk ? $item->produk->nama : 'Unknown',
                    'brand' => $item->produk ? $item->produk->brand : '-',
                    'qty' => $qty,
                    'harga' => $jual,
                    'modalTotal' => $modalTotal,
                    'revenueTotal' => $revenueTotal,
                    'profitTotal' => $profitTotal
                ];
            });

        // 8. Data Kelola Pesanan
        $customerOrders = App\Models\Order::with(['user', 'orderItems'])->orderBy('created_at', 'desc')->get()->map(function($o) {
            return [
                'id' => $o->id,
                'order_id' => '#ord' . $o->id,
                'customer' => $o->user ? $o->user->name : $o->nama,
                'phone' => $o->nomor_hp,
                'items_count' => $o->orderItems->sum('kuantitas'),
                'total' => $o->total_harga,
                'payment' => $o->metode_pembayaran,
                'status' => $o->status_pesanan ?? 'Pending'
            ];
        });

        return view('admin.dashboard', compact(
            'products', 
            'totalTerjual', 
            'totalModal', 
            'totalPendapatan', 
            'totalProfit',
            'aktivitas',
            'stokMasuk',
            'stokKeluar',
            'activitySummary',
            'activityGroups',
            'salesLogs',
            'customerOrders'
        ));
    }
}
