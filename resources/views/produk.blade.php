@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

<a href="/tambah-produk" class="bg-blue-500 text-white px-4 py-2 rounded">
    + Tambah Produk
</a>

<div class="grid grid-cols-3 gap-4 mt-5">
@foreach($products as $p)
    <div class="bg-white border p-4 rounded shadow">
        
        @if($p->gambar)
            <img src="{{ asset('storage/' . $p->gambar) }}" class="w-full h-40 object-cover mb-2 rounded">
        @endif

        <h3 class="font-bold text-lg">{{ $p->nama }}</h3>
        <p class="text-gray-600">Rp {{ $p->harga }}</p>
        <p class="text-sm">Stok: {{ $p->stok }}</p>

        <div class="mt-3 flex gap-2">
            <a href="/edit-produk/{{ $p->id }}" class="bg-yellow-400 px-3 py-1 rounded">
                Edit
            </a>

            <form action="/hapus-produk/{{ $p->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-3 py-1 rounded">
                    Hapus
                </button>
            </form>
        </div>

    </div>
@endforeach
</div>

@endsection