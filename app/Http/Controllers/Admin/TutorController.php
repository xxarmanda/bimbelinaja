<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Models\Setting; // Pastikan Model Setting sudah dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TutorController extends Controller
{
    public function index()
    {
        // Mengambil data setting untuk ditampilkan di form (jika perlu)
        $settings = Setting::whereIn('key', ['tutor_label', 'tutor_title', 'tutor_desc'])
                    ->pluck('value', 'key');
                    
        $tutors = Tutor::latest()->get();
        return view('admin.tutors.index', compact('tutors', 'settings'));
    }

    /**
     * PERBAIKAN: Fungsi Tambahan untuk Konfigurasi Teks Tutor
     * Ini yang menyembuhkan error "Call to undefined method"
     */
    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'tutor_label' => 'nullable|string|max:255',
            'tutor_title' => 'nullable|string|max:255',
            'tutor_desc'  => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Konfigurasi teks seksi tutor berhasil diperbarui! ✨');
    }

    public function create()
    {
        return view('admin.tutors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'tutor_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // SIMPAN LANGSUNG KE PUBLIC/UPLOADS
            $file->move(public_path('uploads/tutors'), $filename);
            $path = 'uploads/tutors/' . $filename;
        }

        Tutor::create([
            'name' => $request->name,
            'subject' => $request->subject,
            'photo' => $path,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.tutors.index')->with('success', 'Data tutor berhasil ditambah!');
    }

    public function edit(Tutor $tutor)
    {
        return view('admin.tutors.edit', compact('tutor'));
    }

    public function update(Request $request, Tutor $tutor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'subject', 'university', 'is_active']);

        if ($request->hasFile('photo')) {
            // Hapus foto lama di folder public jika ada
            if ($tutor->photo && File::exists(public_path($tutor->photo))) {
                File::delete(public_path($tutor->photo));
            }

            $file = $request->file('photo');
            $filename = 'tutor_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/tutors'), $filename);
            
            $data['photo'] = 'uploads/tutors/' . $filename;
        }

        $tutor->update($data);

        return redirect()->route('admin.tutors.index')->with('success', 'Data tutor diperbarui!');
    }

    public function destroy(Tutor $tutor)
    {
        if ($tutor->photo && File::exists(public_path($tutor->photo))) {
            File::delete(public_path($tutor->photo));
        }

        $tutor->delete();
        return redirect()->route('admin.tutors.index')->with('success', 'Tutor berhasil dihapus!');
    }
}