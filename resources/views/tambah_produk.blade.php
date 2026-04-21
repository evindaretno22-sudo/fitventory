<h1>Tambah Produk</h1>

<form method="POST" action="/tambah-produk" enctype="multipart/form-data">
    @csrf
    <input name="nama" placeholder="Nama Produk"><br>
    <input name="harga" placeholder="Harga"><br>
    <input name="stok" placeholder="Stok"><br>
    <input type="file" name="gambar"><br>
    <textarea name="deskripsi" required placeholder="Deskripsi Produk"></textarea><br>
    <button type="submit">Simpan</button>
</form>