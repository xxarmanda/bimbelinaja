<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();

        $testimonial_title = Setting::where('key','testimonial_title')->value('value')
            ?? 'TESTIMONI SISWA';

        $testimonial_subtitle = Setting::where('key','testimonial_subtitle')->value('value')
            ?? 'Cerita pengalaman belajar bersama kami';

        return view('admin.testimonials.index', compact(
            'testimonials',
            'testimonial_title',
            'testimonial_subtitle'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|max:255',
            'title'     => 'required|max:255',
            'testimony' => 'required',
            'image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['name','title','testimony']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'testi_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $data['image'] = 'uploads/testimonials/'.$filename;
        }

        Testimonial::create($data);

        return back()->with('success','Testimoni berhasil ditambahkan 🎉');
    }

    public function updateTitle(Request $request)
    {
        $request->validate([
            'testimonial_title'    => 'required|max:255',
            'testimonial_subtitle'=> 'required|max:255',
        ]);

        Setting::updateOrCreate(
            ['key'=>'testimonial_title'],
            ['value'=>$request->testimonial_title]
        );

        Setting::updateOrCreate(
            ['key'=>'testimonial_subtitle'],
            ['value'=>$request->testimonial_subtitle]
        );

        return back()->with('success','Judul testimoni berhasil diperbarui 🚀');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name'      => 'required|max:255',
            'title'     => 'required|max:255',
            'testimony' => 'required',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['name','title','testimony']);

        if ($request->hasFile('image')) {
            if ($testimonial->image && File::exists(public_path($testimonial->image))) {
                File::delete(public_path($testimonial->image));
            }

            $file = $request->file('image');
            $filename = 'testi_'.time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $data['image'] = 'uploads/testimonials/'.$filename;
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success','Testimoni berhasil diperbarui ✅');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->image && File::exists(public_path($testimonial->image))) {
            File::delete(public_path($testimonial->image));
        }

        $testimonial->delete();

        return back()->with('success','Testimoni berhasil dihapus 🗑️');
    }
}