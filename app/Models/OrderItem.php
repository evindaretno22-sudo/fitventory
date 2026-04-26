<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $fillable = ['order_id', 'id_produk', 'kuantitas', 'harga'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
