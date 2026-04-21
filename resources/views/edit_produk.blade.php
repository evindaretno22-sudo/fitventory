<h1>Edit Produk</h1>

<form method="POST" action="/update-produk/{{ $product->id }}" enctype="multipart/form-data">
    @csrf

    <input name="nama" value="{{ $product->nama }}"><br>
    <input name="harga" value="{{ $product->harga }}"><br>
    <input name="stok" value="{{ $product->stok }}"><br>

    <textarea name="deskripsi">{{ $product->deskripsi }}</textarea><br>

    <input type="file" name="gambar"><br>

    <button type="submit">Update</button>
</form>