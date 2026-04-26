<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\StockHistory;
use App\Models\Produk;
use App\Models\Aktivitas;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
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

    public function storeIn(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'kuantitas' => 'required|numeric|min:1'
        ]);

        $stock = Stock::firstOrCreate(
            ['id_produk' => $request->id_produk],
            ['kuantitas' => 0, 'harga' => 0]
        );

        $stock->kuantitas += $request->kuantitas;
        $stock->save();

        StockHistory::create([
            'id_stok' => $stock->id,
            'tipe' => 'in',
            'kuantitas' => $request->kuantitas,
        ]);

        $produk = Produk::find($request->id_produk);
        $this->logAktivitas('tambah', "Stok {$produk->nama} ditambahkan (+{$request->kuantitas} pcs).");

        return redirect('/admin/dashboard?page=stokmasuk')->with('success', 'Stok berhasil ditambahkan');
    }

    public function storeOut(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'kuantitas' => 'required|numeric|min:1',
            'alasan' => 'required'
        ]);

        $stock = Stock::where('id_produk', $request->id_produk)->first();

        if (!$stock || $stock->kuantitas < $request->kuantitas) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $stock->kuantitas -= $request->kuantitas;
        $stock->save();

        StockHistory::create([
            'id_stok' => $stock->id,
            'tipe' => 'out',
            'kuantitas' => $request->kuantitas,
        ]);

        $produk = Produk::find($request->id_produk);
        $alasanText = $request->alasan === 'Terjual' ? 'terjual' : 'dikeluarkan';
        $logTipe = $request->alasan === 'Terjual' ? 'terjual' : 'edit';
        
        $this->logAktivitas($logTipe, "{$produk->nama} {$alasanText} ({$request->kuantitas} pcs).");

        return redirect('/admin/dashboard?page=stokkeluar')->with('success', 'Stok berhasil dikeluarkan');
    }
}
