<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("order", function (Blueprint $column) {
            $column->id();
            $column->string("id_user");
            $column->string("nama");
            $column->string("alamat");
            $column->string("nomor_hp");
            $column->integer("total_harga");
            $column->enum("status pembayaran", ["pending", "lunas"]);
            $column->enum("metode_pembayaran", ["cash", "transfer", "qris"]);
            $column->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("order");
    }
};
