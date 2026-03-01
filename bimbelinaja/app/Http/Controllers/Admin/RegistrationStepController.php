<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegistrationStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
     * Menyimpan data langkah baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'icon' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
            'order' => 'required|integer'
        ]);

        $path = $request->file('icon')->store('registration_icons', 'public');

        RegistrationStep::create([
            'title' => $path_title = $request->title,
            'description' => $request->description,
            'icon' => $path,
            'order' => $request->order,
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
            'title' => 'required|string|max:255',
            'description' => 'required',
            'order' => 'required|integer'
        ]);

        $data = $request->only(['title', 'description', 'order']);

        if ($request->hasFile('icon')) {
            $request->validate(['icon' => 'image|mimes:png,jpg,jpeg,svg|max:2048']);
            
            // Hapus foto lama jika ada
            if ($registrationStep->icon) {
                Storage::disk('public')->delete($registrationStep->icon);
            }

            $data['icon'] = $request->file('icon')->store('registration_icons', 'public');
        }

        $registrationStep->update($data);

        return redirect()->route('admin.registration-steps.index')
                         ->with('success', 'Langkah pendaftaran berhasil diperbarui!');
    }

    /**
     * Menghapus langkah pendaftaran
     */
    public function destroy(RegistrationStep $registrationStep)
    {
        if ($registrationStep->icon) {
            Storage::disk('public')->delete($registrationStep->icon);
        }

        $registrationStep->delete();

        return redirect()->route('admin.registration-steps.index')
                         ->with('success', 'Langkah pendaftaran berhasil dihapus!');
    }
}