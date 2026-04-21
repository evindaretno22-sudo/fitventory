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
        Schema::create("produk", function (Blueprint $column) {
            $column->id();
            $column->string("kategori");
            $column->string("ukuran", 3);
            $column->string("kondisi");
            $column->string("brand");
            $column->string("warna", 50);
            $column->string("nama", 255);
            $column->integer("harga");
            $column->string("lokasi");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("produk");
    }
};
