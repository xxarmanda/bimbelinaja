<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentTestimonial;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Menampilkan daftar testimoni di halaman Admin
     */
    public function index() 
    {
        $testimonials = StudentTestimonial::latest()->get();
        // Menggunakan default value jika setting tidak ada agar tidak error
        $settings = Setting::pluck('value', 'key')->all();

        return view('admin.student_testimonials.index', compact('testimonials', 'settings'));
    }

    public function create() 
    {
        return view('admin.student_testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'title'   => 'required|string|max:255', // Ini untuk bagian "1.5 TAHUN" atau Jabatan
            'message' => 'required|string',       // Ini untuk isi testimoni
            'image'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('testimonials', 'public');

        StudentTestimonial::create([
            'name'    => $request->name,
            'title'   => $request->title,
            'message' => $request->message,
            'image'   => $imagePath,
        ]);

        return redirect()->route('admin.student-testimonials.index')->with('success', 'Testimoni berhasil dipublikasikan! ✨');
    }

    public function edit($id)
    {
        $testimonial = StudentTestimonial::findOrFail($id);
        return view('admin.student_testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = StudentTestimonial::findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'title'   => 'required|string|max:255',
            'message' => 'required',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'title', 'message']);

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.student-testimonials.index')->with('success', 'Testimoni berhasil diperbarui! ✨');
    }

    public function destroy($id)
    {
        $testimonial = StudentTestimonial::findOrFail($id);

        if ($testimonial->image && Storage::disk('public')->exists($testimonial->image)) {
            Storage::disk('public')->delete($testimonial->image);
        }

        $testimonial->delete();

        return redirect()->route('admin.student-testimonials.index')->with('success', 'Data berhasil dihapus.');
    }
}