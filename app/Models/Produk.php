<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    public $timestamps = false;
    protected $fillable = ['kategori', 'ukuran', 'kondisi', 'brand', 'warna', 'nama', 'harga', 'lokasi'];

    public function stock()
    {
        return $this->hasOne(Stock::class, 'id_produk');
    }
}
