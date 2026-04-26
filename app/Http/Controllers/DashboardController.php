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
                'note' => 'Stok Masuk'
            ];
        });

        // 5. Riwayat Stok Keluar
        $stokKeluar = StockHistory::with(['stock.produk'])->where('tipe', 'out')->orderBy('created_at', 'desc')->get()->map(function($s) {
            return [
                'date' => $s->created_at->format('d/m/Y H:i'),
                'productName' => $s->stock && $s->stock->produk ? $s->stock->produk->nama : 'Unknown',
                'qty' => $s->kuantitas,
                'reason' => 'Terjual / Keluar',
                'note' => '-'
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
            'stokKeluar'
        ));
    }
}
