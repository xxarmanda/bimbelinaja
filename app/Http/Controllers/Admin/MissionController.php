<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\Setting;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Menampilkan daftar misi dan form visi
     */
    public function index()
    {
        $missions = Mission::all();
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.missions.index', compact('missions', 'settings'));
    }

    /**
     * Menyimpan Misi Baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Mission::create($data);
        return redirect()->back()->with('success', 'Misi strategis berhasil ditambahkan!');
    }

    /**
     * Menghapus Misi
     */
    public function destroy(Mission $mission)
    {
        $mission->delete();
        return redirect()->back()->with('success', 'Misi berhasil dihapus!');
    }
}