<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\Setting; // Penting agar teks karir bisa terbaca
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BenefitController extends Controller
{
    /**
     * Menampilkan halaman index dengan data keuntungan dan pengaturan teks
     */
    public function index()
    {
        // Ambil data keuntungan tutor terbaru
        $benefits = Benefit::latest()->get();

        // Ambil pengaturan teks khusus karir untuk form di bagian atas
        $settings = Setting::pluck('value', 'key')->all();

        return view('admin.benefits.index', compact('benefits', 'settings'));
    }

    /**
     * Form untuk mengedit data keuntungan
     */
    public function edit(Benefit $benefit)
    {
        return view('admin.benefits.edit', compact('benefit'));
    }

    /**
     * Update data keuntungan beserta ikonnya
     */
    public function update(Request $request, Benefit $benefit)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($benefit->image) {
                Storage::disk('public')->delete($benefit->image);
            }
            // Simpan gambar baru ke folder benefits
            $data['image'] = $request->file('image')->store('benefits', 'public');
        }

        $benefit->update($data);

        return redirect()->route('admin.benefits.index')->with('success', 'Keuntungan berhasil diperbarui!');
    }

    /**
     * Menyimpan data keuntungan baru
     */
    public function store(Request $request) 
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048' 
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('benefits', 'public');
        }

        Benefit::create($data);
        return back()->with('success', 'Keuntungan baru berhasil ditambahkan!');
    }

    /**
     * Menghapus data keuntungan dan file gambarnya
     */
    public function destroy(Benefit $benefit) 
    {
        // Pastikan gambar di storage juga terhapus agar tidak memenuhi server
        if ($benefit->image) {
            Storage::disk('public')->delete($benefit->image);
        }
        
        $benefit->delete();
        return back()->with('success', 'Berhasil dihapus!');
    }
}