<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OnlineSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OnlineSettingController extends Controller
{
    /**
     * Menampilkan daftar semua seksi (Hero, Fitur, Statistik) yang bisa diedit.
     */
    public function index()
    {
        // Mengambil semua data pengaturan laman les online
        $settings = OnlineSetting::all();
        return view('admin.online_settings.index', compact('settings'));
    }

    /**
     * Menampilkan formulir edit untuk seksi tertentu.
     */
    public function edit($id)
    {
        $setting = OnlineSetting::findOrFail($id);
        return view('admin.online_settings.edit', compact('setting'));
    }

    /**
     * Memperbarui deskripsi dan foto berdasarkan input admin.
     */
   public function update(Request $request, $id)
{
    $setting = OnlineSetting::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
    ]);

    $data = [
        'title' => $request->title,
        'description' => $request->description,
    ];

    // Jika admin upload gambar baru
    if ($request->hasFile('image')) {
        if ($setting->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($setting->image);
        }
        $data['image'] = $request->file('image')->store('online_page', 'public');
    }

    $setting->update($data);

    return redirect()->route('admin.online-settings.index')->with('success', 'Konten Berhasil Diperbarui! ✨');
}
}