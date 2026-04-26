<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $table = 'stock_history';
    protected $fillable = ['id_stok', 'tipe', 'kuantitas'];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'id_stok');
    }
}
