<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all();
    return view('produk', compact('products'));
}

public function create()
{
    return view('tambah_produk');
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'harga' => 'required',
        'stok' => 'required',
        'deskripsi' => 'required',
    ]);

    $gambarPath = null;

    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('produk', 'public');
    }

    Product::create([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'gambar' => $gambarPath
    ]);

    return redirect('/produk');
}

public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('edit_produk', compact('product'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $gambarPath = $product->gambar;

    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('produk', 'public');
    }

    $product->update([
        'nama' => $request->nama,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'gambar' => $gambarPath
    ]);

    return redirect('/produk');
}

public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect('/produk');
}
}
