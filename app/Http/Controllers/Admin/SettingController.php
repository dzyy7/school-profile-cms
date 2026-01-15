<?php

namespace App\Http\Controllers\Admin;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // Mengambil semua setting dan menjadikannya array ['key' => 'value']
        // Contoh: ['school_name' => 'SMK 1', 'school_email' => '...']
        $settings = Settings::pluck('value', 'key')->toArray();

        return view('Admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'school_name' => 'required|string|max:255',
            'school_logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Max 2MB
            'tahun_berdiri'   => 'nullable|integer|digits:4',
            'peserta_didik'   => 'nullable|integer|min:0',
            'tenaga_pendidik' => 'nullable|integer|min:0',
            'alumni'          => 'nullable|integer|min:0',
        ]);

        // 2. Ambil semua data input kecuali _token dan file logo
        $data = $request->except(['_token', '_method', 'school_logo']);

        // 3. Loop dan simpan data teks (Key-Value)
        foreach ($data as $key => $value) {
            Settings::updateOrCreate(
                ['key' => $key],
                ['value' => $value ?? ''] // Simpan string kosong jika null
            );
        }

        // 4. Handle Upload Logo (Khusus)
        if ($request->hasFile('school_logo')) {
            $file = $request->file('school_logo');

            // Hapus logo lama jika ada
            $oldLogo = Settings::find('school_logo');
            if ($oldLogo && $oldLogo->value) {
                Storage::disk('public')->delete($oldLogo->value);
            }

            // Simpan logo baru
            $path = $file->store('settings', 'public');

            Settings::updateOrCreate(
                ['key' => 'school_logo'],
                ['value' => $path]
            );
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}