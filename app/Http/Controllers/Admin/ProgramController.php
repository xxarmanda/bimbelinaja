<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

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
     * Menyimpan program baru ke database (Upload fisik ke Public/Storage)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $filename = 'program_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Tentukan lokasi folder fisik di public/storage/programs
            $targetFolder = public_path('storage/programs');

            // Buat folder otomatis jika belum ada
            if (!File::isDirectory($targetFolder)) {
                File::makeDirectory($targetFolder, 0777, true, true);
            }

            // Pindahkan file secara fisik
            $file->move($targetFolder, $filename);
            
            // Simpan path yang bisa langsung dibaca helper asset()
            $path = 'storage/programs/' . $filename;
        }

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
     * Memproses update data (Ganti gambar fisik)
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
            // 1. Hapus foto lama jika ada secara fisik
            if ($program->icon && File::exists(public_path($program->icon))) {
                File::delete(public_path($program->icon));
            }

            // 2. Upload foto baru ke public/storage/programs
            $file = $request->file('icon');
            $filename = 'program_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $targetFolder = public_path('storage/programs');
            if (!File::isDirectory($targetFolder)) {
                File::makeDirectory($targetFolder, 0777, true, true);
            }

            $file->move($targetFolder, $filename);
            $data['icon'] = 'storage/programs/' . $filename;
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil diperbarui!');
    }

    /**
     * Menghapus program dan file fisik ikonnya
     */
    public function destroy(Program $program)
    {
        // Hapus file fisik
        if ($program->icon && File::exists(public_path($program->icon))) {
            File::delete(public_path($program->icon));
        }

        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dihapus!');
    }

    /**
     * Menampilkan daftar program di HALAMAN DEPAN
     */
    public function index_public()
    {
        $programs = Program::all(); 
        return view('programs.index', compact('programs'));
    }

    /**
     * Menampilkan detail program di HALAMAN PUBLIK
     */
    public function show(Program $program)
    {
        $program->load('subPrograms');
        return view('programs.show', compact('program'));
    }
}