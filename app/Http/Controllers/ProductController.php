<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Stock;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'ukuran' => 'required',
            'kondisi' => 'required',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $produk = Produk::create([
            'kategori' => $request->kategori,
            'ukuran' => $request->ukuran,
            'kondisi' => $request->kondisi,
            'brand' => $request->brand ?? '-',
            'warna' => $request->warna ?? '#000000',
            'nama' => $request->nama,
            'harga' => $request->harga,
            'lokasi' => $request->lokasi ?? '-'
        ]);

        if ($request->has('stok') && $request->stok > 0) {
            Stock::create([
                'id_produk' => $produk->id,
                'kuantitas' => $request->stok,
                'harga' => $request->harga_modal ?? 0
            ]);
        }

        $this->logAktivitas('tambah', "{$produk->nama} ditambahkan ke inventory.");

        return redirect('/admin/dashboard?page=produk')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $oldHarga = $produk->harga;

        $produk->update([
            'kategori' => $request->kategori ?? $produk->kategori,
            'ukuran' => $request->ukuran ?? $produk->ukuran,
            'kondisi' => $request->kondisi ?? $produk->kondisi,
            'brand' => $request->brand ?? $produk->brand,
            'warna' => $request->warna ?? $produk->warna,
            'nama' => $request->nama ?? $produk->nama,
            'harga' => $request->harga ?? $produk->harga,
            'lokasi' => $request->lokasi ?? $produk->lokasi
        ]);

        $this->logAktivitas('edit', "Produk {$produk->nama} diperbarui.");

        if ($oldHarga != $produk->harga) {
            $this->logAktivitas('harga_diubah', "Harga {$produk->nama} diubah dari Rp{$oldHarga} ke Rp{$produk->harga}.");
        }

        return redirect('/admin/dashboard?page=produk')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $nama = $produk->nama;
        $produk->delete();

        $this->logAktivitas('edit', "Produk {$nama} dihapus dari inventory.");

        return redirect('/admin/dashboard?page=produk')->with('success', 'Produk berhasil dihapus');
    }
}
