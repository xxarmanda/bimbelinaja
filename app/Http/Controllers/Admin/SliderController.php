<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Gunakan File Facade untuk hapus foto di folder public

class SliderController extends Controller
{
    /**
     * Menampilkan daftar slider dan setting teks hero
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        // Ambil semua data setting untuk teks hero tetap dipertahankan
        $settings = Setting::pluck('value', 'key')->all(); 
        
        return view('admin.sliders.index', compact('sliders', 'settings'));
    }

    /**
     * Menyimpan gambar slider baru langsung ke folder Public
     */
    public function store(Request $request) {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg|max:2048']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'slider_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Simpan fisik file ke public/uploads/sliders
            $file->move(public_path('uploads/sliders'), $filename);
            $path = 'uploads/sliders/' . $filename;
        }

        Slider::create([
            'title' => $request->title,
            'image' => $path, // Jalur yang disimpan: uploads/sliders/namafile.jpg
        ]);

        return back()->with('success', 'Slider berhasil ditambah! ');
    }

    /**
     * Update Slider (Ganti gambar di folder Public)
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        $data = [
            'title' => $request->title,
        ];

        if ($request->hasFile('image')) {
            // 1. Hapus gambar lama dari folder public/uploads/sliders jika ada
            if ($slider->image && File::exists(public_path($slider->image))) {
                File::delete(public_path($slider->image));
            }

            // 2. Upload gambar baru
            $file = $request->file('image');
            $filename = 'slider_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sliders'), $filename);
            
            $data['image'] = 'uploads/sliders/' . $filename;
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil diperbarui!');
    }

    /**
     * Menghapus slider dan file fisiknya di folder Public
     */
    public function destroy(Slider $slider)
    {
        // Hapus file fisik dari folder public/uploads/sliders
        if ($slider->image && File::exists(public_path($slider->image))) {
            File::delete(public_path($slider->image));
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider dihapus!');
    }
}