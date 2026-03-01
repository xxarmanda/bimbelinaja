<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceAreaController extends Controller
{
    /**
     * Tampilkan daftar wilayah Ciayumajakuning.
     */
    public function index()
    {
        $areas = ServiceArea::latest()->get();
        return view('admin.service_areas.index', compact('areas'));
    }

    /**
     * Simpan wilayah baru (Cirebon, Indramayu, dll).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'city_name'   => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('service_icons', 'public');
        }

        ServiceArea::create($data);

        return back()->with('success', 'Wilayah Ciayumajakuning Berhasil Ditambah! 📍');
    }

    /**
     * Tampilkan halaman edit wilayah.
     */
    public function edit(ServiceArea $service_area)
    {
        // PERBAIKAN: Buat alias $area agar sesuai dengan yang dipanggil di file edit.blade.php
        $area = $service_area; 
        
        // Kita kirim 'area' agar Blade tidak lagi error "Undefined variable $area"
        return view('admin.service_areas.edit', compact('area'));
    }

    /**
     * Update data wilayah & ganti ikon lama.
     */
    public function update(Request $request, ServiceArea $service_area)
    {
        $data = $request->validate([
            'city_name'   => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024',
        ]);

        // LOGIKA GANTI IKON: Hapus file lama jika ada upload baru
        if ($request->hasFile('icon')) {
            if ($service_area->icon) {
                Storage::disk('public')->delete($service_area->icon);
            }
            $data['icon'] = $request->file('icon')->store('service_icons', 'public');
        }

        $service_area->update($data);

        // Redirect ke index agar perubahan langsung terlihat di tabel
        return redirect()->route('admin.service-areas.index')->with('success', 'Data Wilayah Berhasil Diperbarui! ✨');
    }

    /**
     * Hapus wilayah beserta ikonnya.
     */
    public function destroy(ServiceArea $service_area)
    {
        if ($service_area->icon) {
            Storage::disk('public')->delete($service_area->icon);
        }
        
        $service_area->delete();

        return back()->with('success', 'Wilayah dihapus dari daftar layanan.');
    }
}