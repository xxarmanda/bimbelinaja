<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = StudentTestimonial::latest()->get();
        return view('admin.student_testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.student_testimonials.create');
    }

    public function store(Request $request)
    {
        // YouTube dihapus, Image jadi Wajib (Required) karena tidak ada video lagi
        $request->validate([
            'name'    => 'required|string|max:255',
            'title'   => 'required|string|max:255',
            'message' => 'required',
            'image'   => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        $data = $request->only(['name', 'title', 'message']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('student_testimonials', 'public');
        }

        StudentTestimonial::create($data);

        // Pastikan nama route ini (admin.student-testimonials.index) ada di web.php kamu
        return redirect()->route('admin.student-testimonials.index')
            ->with('success', 'Testimoni foto berhasil dipublish! ✨');
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
            'message' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', 
        ]);

        $data = $request->only(['name', 'title', 'message']);

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $data['image'] = $request->file('image')->store('student_testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.student-testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui! ✨');
    }

    public function destroy($id)
    {
        $testimonial = StudentTestimonial::findOrFail($id);

        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }

        $testimonial->delete();

        return redirect()->route('admin.student-testimonials.index')
            ->with('success', 'Data telah dihapus.');
    }
}