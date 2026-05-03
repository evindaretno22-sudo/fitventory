<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['id_user', 'nama', 'alamat', 'nomor_hp', 'total_harga', 'status pembayaran', 'metode_pembayaran', 'status_pesanan'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
