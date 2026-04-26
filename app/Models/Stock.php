<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';
    protected $fillable = ['id_produk', 'kuantitas', 'harga'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
