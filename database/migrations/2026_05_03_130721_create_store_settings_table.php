<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Seed default values
        $defaults = [
            ['key' => 'nama_toko',   'value' => 'Fitventory Thrift Store'],
            ['key' => 'alamat',      'value' => 'Jl. Pahlawan No. 456, Jakarta Pusat, DKI Jakarta 10110'],
            ['key' => 'telepon',     'value' => '021-12345678'],
            ['key' => 'email',       'value' => 'info@fitventory.com'],
            ['key' => 'whatsapp',    'value' => '6281234567890'],
            ['key' => 'instagram',   'value' => '@fitventory_thrift'],
            ['key' => 'maps_url',    'value' => '#'],
            ['key' => 'deskripsi',   'value' => 'Toko thrift terpercaya dengan koleksi fashion berkualitas. Kami menyediakan berbagai macam pakaian branded second dan new dengan harga terjangkau.'],
            ['key' => 'jam_senin_jumat', 'value' => '09:00 - 21:00'],
            ['key' => 'jam_sabtu_minggu', 'value' => '10:00 - 22:00'],
        ];

        foreach ($defaults as $d) {
            DB::table('store_settings')->insert(array_merge($d, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('store_settings');
    }
};
