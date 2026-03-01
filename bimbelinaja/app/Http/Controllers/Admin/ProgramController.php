<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    /**
     * Menampilkan daftar program di DASHBOARD ADMIN
     */
    public function index()
    {
        $programs = Program::latest()->get();
        return view('admin.programs.index', compact('programs'));
    }

    /**
     * Menampilkan form untuk menambah program baru
     */
    public function create()
    {
        return view('admin.programs.create');
    }

    /**
     * Menyimpan program baru ke database
     */
    public function store(Request $request)
    {
    // Tambahkan ini untuk mengecek isi kiriman form
    // dd($request->all(), $request->file('icon')); 

    $request->validate([
        'name' => 'required|string|max:255',
        'icon' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
    ]);

        $path = $request->file('icon')->store('programs', 'public');

        Program::create([
            'name' => $request->name,
            'icon' => $path,
        ]);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit
     */
    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    /**
     * Memproses update data
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
        ];

        if ($request->hasFile('icon')) {
            Storage::disk('public')->delete($program->icon);
            $data['icon'] = $request->file('icon')->store('programs', 'public');
        }

        $program->update($data);

       return redirect()->route('admin.programs.index')->with('success', 'Program berhasil diperbarui!');
    }

    /**
     * Menghapus program dan file ikonnya
     */
    public function destroy(Program $program)
    {
        Storage::disk('public')->delete($program->icon);
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dihapus!');
    }

    // ==========================================
    // METHOD TAMBAHAN UNTUK HALAMAN PUBLIK
    // ==========================================

    /**
     * Menampilkan daftar program di HALAMAN DEPAN (Welcome/Program Index)
     */
    public function index_public()
    {
        // Mengambil semua program untuk ditampilkan ke siswa
        $programs = Program::all(); 
        
        // Mengarahkan ke resources/views/programs/index.blade.php
        return view('programs.index', compact('programs'));
    }

    /**
     * Menampilkan detail program (sub-program) di HALAMAN PUBLIK
     * Digunakan saat user mengeklik kartu program (SD, SMP, SMA, dll)
     */
    public function show(Program $program)
    {
        // Eager load subPrograms agar data mata pelajaran ikut terbawa
        $program->load('subPrograms');
        
        // Mengarahkan ke resources/views/programs/show.blade.php
        return view('programs.show', compact('program'));
    }
}