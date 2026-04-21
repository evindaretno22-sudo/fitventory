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
        Schema::create("aktivitas", function (Blueprint $column) {
            $column->id();
            $column->enum("tipe", ["tambah", "edit", "terjual", "harga_diubah"]);
            $column->dateTime("tanggal");
            $column->text("deskripsi");
            $column->string("id_user");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("aktivitas");
    }
};
