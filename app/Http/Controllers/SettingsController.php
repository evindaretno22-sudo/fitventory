<?php

namespace App\Http\Controllers;

use App\Models\StoreSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'nama_toko'          => 'required|string|max:255',
            'alamat'             => 'required|string|max:500',
            'telepon'            => 'required|string|max:50',
            'email'              => 'required|email|max:255',
            'whatsapp'           => 'required|string|max:20',
            'instagram'          => 'nullable|string|max:100',
            'maps_url'           => 'nullable|string|max:500',
            'deskripsi'          => 'nullable|string|max:1000',
            'jam_senin_jumat'    => 'nullable|string|max:50',
            'jam_sabtu_minggu'   => 'nullable|string|max:50',
        ]);

        $fields = [
            'nama_toko', 'alamat', 'telepon', 'email',
            'whatsapp', 'instagram', 'maps_url', 'deskripsi',
            'jam_senin_jumat', 'jam_sabtu_minggu',
        ];

        foreach ($fields as $field) {
            StoreSetting::set($field, $request->input($field, ''));
        }

        return back()->with('success', 'Informasi toko berhasil diperbarui!');
    }
}
