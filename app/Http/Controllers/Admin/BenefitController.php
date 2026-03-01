<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\Setting;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    // Tampilkan halaman admin benefits & teks karir
    public function index()
    {
        $benefits = Benefit::latest()->get();
        $settings = Setting::pluck('value', 'key')->all();

        return view('admin.benefits.index', compact('benefits', 'settings'));
    }

    // Store keuntungan baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            $file->move(public_path('uploads/benefits'), $filename);

            // Simpan RELATIVE PATH ke database
            $data['image'] = 'benefits/' . $filename;
        }

        Benefit::create($data);

        return back()->with('success', 'Keuntungan baru berhasil ditambahkan!');
    }

    // Edit keuntungan
    public function edit(Benefit $benefit)
    {
        return view('admin.benefits.edit', compact('benefit'));
    }

    // Update keuntungan
    public function update(Request $request, Benefit $benefit)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada
            if ($benefit->image && file_exists(public_path('uploads/' . $benefit->image))) {
                unlink(public_path('uploads/' . $benefit->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            $file->move(public_path('uploads/benefits'), $filename);

            $data['image'] = 'benefits/' . $filename;
        }

        $benefit->update($data);

        return redirect()
            ->route('admin.benefits.index')
            ->with('success', 'Keuntungan berhasil diperbarui!');
    }

    // Hapus keuntungan
    public function destroy(Benefit $benefit)
    {
        if ($benefit->image && file_exists(public_path('uploads/' . $benefit->image))) {
            unlink(public_path('uploads/' . $benefit->image));
        }

        $benefit->delete();

        return back()->with('success', 'Keuntungan berhasil dihapus!');
    }

    // Update Teks Karir
    public function updateSettings(Request $request)
    {
        $fields = [
            'career_title',
            'career_brand',
            'career_slogan',
            'career_benefit_title',
            'career_benefit_brand',
            'career_benefit_subtitle',
        ];

        foreach ($fields as $field) {
            Setting::updateOrCreate(
                ['key' => $field],
                ['value' => $request->input($field)]
            );
        }

        return redirect()->back()->with('success', 'Teks Karir berhasil diperbarui.');
    }
}