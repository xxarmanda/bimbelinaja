<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceArea;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceAreaController extends Controller
{
    /**
     * Menampilkan daftar area layanan dan pengaturan teks.
     */
    public function index()
    {
        $settings = Setting::whereIn('key', ['area_label', 'area_title', 'area_desc'])
            ->pluck('value', 'key');

        $areas = ServiceArea::latest()->get();

        return view('admin.service_areas.index', compact('areas', 'settings'));
    }

    /**
     * Menangani update teks Label, Judul, dan Deskripsi Area
     */
    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'area_label' => 'nullable|string|max:255',
            'area_title' => 'nullable|string|max:255',
            'area_desc'  => 'nullable|string',
        ]);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Pengaturan teks area berhasil diperbarui.');
    }

    /**
     * Menyimpan wilayah baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'city_name'   => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = 'area_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/service_icons'), $filename);
            $path = 'uploads/service_icons/' . $filename;
        }

        ServiceArea::create([
            'city_name'   => $request->city_name,
            'description' => $request->description,
            'icon'        => $path,
        ]);

        return redirect()
            ->route('admin.service-areas.index')
            ->with('success', 'Area layanan berhasil ditambah!');
    }

    /**
     * Menampilkan halaman edit.
     */
    public function edit(ServiceArea $serviceArea)
    {
        $area = $serviceArea;

        return view('admin.service_areas.edit', compact('area'));
    }

    /**
     * Update data wilayah.
     */
    public function update(Request $request, ServiceArea $serviceArea)
    {
        $request->validate([
            'city_name' => 'required|string|max:255',
            'icon'      => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $data = $request->only(['city_name', 'description']);

        if ($request->hasFile('icon')) {
            if ($serviceArea->icon && File::exists(public_path($serviceArea->icon))) {
                File::delete(public_path($serviceArea->icon));
            }

            $file = $request->file('icon');
            $filename = 'area_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/service_icons'), $filename);
            $data['icon'] = 'uploads/service_icons/' . $filename;
        }

        $serviceArea->update($data);

        return redirect()
            ->route('admin.service-areas.index')
            ->with('success', 'Area layanan diperbarui!');
    }

    /**
     * Hapus wilayah.
     */
    public function destroy(ServiceArea $serviceArea)
    {
        if ($serviceArea->icon && File::exists(public_path($serviceArea->icon))) {
            File::delete(public_path($serviceArea->icon));
        }

        $serviceArea->delete();

        return redirect()
            ->route('admin.service-areas.index')
            ->with('success', 'Area layanan dihapus!');
    }
}