<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Aktivitas;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private function logAktivitas($tipe, $deskripsi)
    {
        Aktivitas::create([
            'tipe'     => $tipe,
            'tanggal'  => now(),
            'deskripsi'=> $deskripsi,
            'id_user'  => Auth::id() ?? 1
        ]);
    }

    /**
     * Simpan pesanan baru dari halaman pembayaran.
     * Items dikirim sebagai JSON dalam hidden input.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'             => 'required|string|max:255',
            'nomor_hp'         => 'required|string|max:20',
            'alamat'           => 'required|string|max:500',
            'metode_pembayaran'=> 'required|string',
            'items'            => 'required|string', // JSON
        ]);

        $items = json_decode($request->items, true);

        if (empty($items)) {
            return redirect('/keranjang')->with('error', 'Keranjang kosong, tidak dapat membuat pesanan.');
        }

        $subtotal = collect($items)->sum(fn($i) => $i['price'] * $i['quantity']);
        $ongkir   = 15000;
        $total    = $subtotal + $ongkir;

        DB::beginTransaction();
        try {
            // Buat record order
            $order = Order::create([
                'id_user'           => Auth::id(),
                'nama'              => $request->nama,
                'alamat'            => $request->alamat,
                'nomor_hp'          => $request->nomor_hp,
                'total_harga'       => $total,
                'status pembayaran' => 'pending',
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pesanan'    => 'Pending',
            ]);

            // Buat order items
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id'  => $order->id,
                    'id_produk' => $item['id'],
                    'kuantitas' => $item['quantity'],
                    'harga'     => $item['price'],
                ]);

                // Kurangi stok produk
                $produk = Produk::find($item['id']);
                if ($produk && $produk->stock) {
                    $stok = $produk->stock;
                    $stok->kuantitas = max(0, $stok->kuantitas - $item['quantity']);
                    $stok->save();
                }
            }

            $this->logAktivitas('terjual', "Pesanan baru #ord{$order->id} dari {$request->nama} dengan metode {$request->metode_pembayaran}. Total: Rp " . number_format($total, 0, ',', '.'));

            DB::commit();

            return redirect('/pesanan?order_id=' . $order->id)
                ->with('success', 'Pesanan berhasil dibuat! Silakan tunggu konfirmasi dari kami.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/pembayaran')->with('error', 'Terjadi kesalahan saat membuat pesanan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan pesanan milik user yang sedang login.
     */
    public function myOrders()
    {
        $orders = Order::with('orderItems.produk')
            ->where('id_user', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($o) {
                return [
                    'id'        => $o->id,
                    'order_id'  => '#ord' . $o->id,
                    'tanggal'   => $o->created_at->format('d F Y'),
                    'total'     => $o->total_harga,
                    'metode'    => $o->metode_pembayaran,
                    'status'    => $o->status_pesanan ?? 'Pending',
                    'items'     => $o->orderItems->map(fn($item) => [
                        'name'     => $item->produk ? $item->produk->nama : 'Produk',
                        'size'     => $item->produk ? $item->produk->ukuran : '-',
                        'color'    => $item->produk ? $item->produk->warna : '-',
                        'quantity' => $item->kuantitas,
                        'price'    => $item->harga,
                    ])->values()->all(),
                ];
            });

        return view('pelanggan.pesanan', compact('orders'));
    }

    /**
     * Update status pesanan (admin).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pesanan' => 'required|string'
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status_pesanan;
        $order->status_pesanan = $request->status_pesanan;
        $order->save();

        if ($oldStatus !== $order->status_pesanan) {
            $this->logAktivitas('edit', "Status pesanan #ord{$order->id} diubah dari {$oldStatus} menjadi {$order->status_pesanan}.");
        }

        return back()->with('success', "Status pesanan #ord{$order->id} berhasil diperbarui menjadi {$order->status_pesanan}.");
    }
}
