<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OnlineSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OnlineSettingController extends Controller
{
    public function index()
    {
        $settings = OnlineSetting::all();
        return view('admin.online_settings.index', compact('settings'));
    }

    public function edit($id)
    {
        $setting = OnlineSetting::findOrFail($id);
        return view('admin.online_settings.edit', compact('setting'));
    }

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

        if ($request->hasFile('image')) {

            // Path folder tujuan
            $destinationPath = public_path('online_page');

            // Buat folder jika belum ada
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            // Hapus gambar lama jika ada
            if ($setting->image && File::exists(public_path($setting->image))) {
                File::delete(public_path($setting->image));
            }

            // Upload gambar baru
            $file = $request->file('image');
            $filename = 'online_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move($destinationPath, $filename);

            // Simpan path bersih ke database
            $data['image'] = 'online_page/' . $filename;
        }

        $setting->update($data);

        return redirect()
            ->route('admin.online-settings.index')
            ->with('success', 'Konten Berhasil Diperbarui! ✨');
    }
}