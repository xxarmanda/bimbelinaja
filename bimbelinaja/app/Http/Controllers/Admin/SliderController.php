<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Setting; // TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        // Ambil semua data setting untuk teks hero
        $settings = Setting::pluck('value', 'key')->all(); 
        
        return view('admin.sliders.index', compact('sliders', 'settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'image' => $path,
            'title' => $request->title,
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Gambar slider berhasil ditambah!');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider dihapus!');
    }
}