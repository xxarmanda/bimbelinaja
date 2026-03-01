<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RegistrationStepController extends Controller
{
    /**
     * Menampilkan daftar langkah pendaftaran
     */
    public function index()
    {
        $steps = RegistrationStep::orderBy('order')->get();
        return view('admin.registration_steps.index', compact('steps'));
    }

    /**
     * Form tambah langkah baru
     */
    public function create()
    {
        return view('admin.registration_steps.create');
    }

    /**
     * Menyimpan data langkah baru (UPLOAD KE PUBLIC)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'icon'        => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'order'       => 'required|integer'
        ]);

        $path = null;

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = 'step_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Pastikan folder ada
            $folder = public_path('uploads/registration_icons');
            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0755, true);
            }

            $file->move($folder, $filename);
            $path = 'uploads/registration_icons/' . $filename;
        }

        RegistrationStep::create([
            'title'       => $request->title,
            'description' => $request->description,
            'icon'        => $path,
            'order'       => $request->order,
        ]);

        return redirect()->route('admin.registration-steps.index')
                         ->with('success', 'Langkah pendaftaran berhasil ditambahkan!');
    }

    /**
     * Form edit data
     */
    public function edit(RegistrationStep $registrationStep)
    {
        return view('admin.registration_steps.edit', compact('registrationStep'));
    }

    /**
     * Update data langkah pendaftaran
     */
    public function update(Request $request, RegistrationStep $registrationStep)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'order'       => 'required|integer'
        ]);

        $data = $request->only(['title', 'description', 'order']);

        if ($request->hasFile('icon')) {
            $request->validate(['icon' => 'image|mimes:png,jpg,jpeg,svg|max:2048']);

            // Hapus icon lama
            if ($registrationStep->icon && File::exists(public_path($registrationStep->icon))) {
                File::delete(public_path($registrationStep->icon));
            }

            $file = $request->file('icon');
            $filename = 'step_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $folder = public_path('uploads/registration_icons');
            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0755, true);
            }

            $file->move($folder, $filename);
            $data['icon'] = 'uploads/registration_icons/' . $filename;
        }

        $registrationStep->update($data);

        return redirect()->route('admin.registration-steps.index')
                         ->with('success', 'Langkah pendaftaran berhasil diperbarui!');
    }

    /**
     * Menghapus langkah pendaftaran + file
     */
    public function destroy(RegistrationStep $registrationStep)
    {
        if ($registrationStep->icon && File::exists(public_path($registrationStep->icon))) {
            File::delete(public_path($registrationStep->icon));
        }

        $registrationStep->delete();

        return redirect()->route('admin.registration-steps.index')
                         ->with('success', 'Langkah pendaftaran berhasil dihapus!');
    }
}