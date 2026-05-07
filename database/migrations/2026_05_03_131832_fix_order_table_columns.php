<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah metode_pembayaran dari enum terbatas menjadi string bebas
        // agar support: cod, transfer_bank, ewallet, qris, dll
        DB::statement("ALTER TABLE `order` MODIFY `metode_pembayaran` VARCHAR(50) NOT NULL DEFAULT 'transfer_bank'");

        // Pastikan status_pesanan sudah ada (dari migration sebelumnya)
        if (!Schema::hasColumn('order', 'status_pesanan')) {
            Schema::table('order', function (Blueprint $table) {
                $table->string('status_pesanan')->default('Pending')->after('metode_pembayaran');
            });
        }
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `order` MODIFY `metode_pembayaran` ENUM('cash','transfer','qris') NOT NULL");
    }
};
