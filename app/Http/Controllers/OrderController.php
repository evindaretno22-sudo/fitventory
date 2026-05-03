<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private function logAktivitas($tipe, $deskripsi)
    {
        Aktivitas::create([
            'tipe' => $tipe,
            'tanggal' => now(),
            'deskripsi' => $deskripsi,
            'id_user' => Auth::id() ?? 1
        ]);
    }

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
            $this->logAktivitas('edit', "Status pesanan #ord{$order->id} diubah menjadi {$order->status_pesanan}.");
        }

        return back()->with('success', "Status pesanan #ord{$order->id} berhasil diperbarui menjadi {$order->status_pesanan}.");
    }
}
