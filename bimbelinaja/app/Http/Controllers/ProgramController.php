<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // Pastikan memanggil base controller
use App\Models\Program;
use App\Models\SubProgram;
use App\Models\OnlineSetting; // WAJIB: Agar bisa memanggil data konten dari Admin
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    // ==========================================
    // --- 1. RUTE ADMIN (KELOLA JENJANG) ---
    // ==========================================

    public function index()
    {
        $programs = Program::latest()->get();
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('program_icons', 'public');
        }

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program baru berhasil ditambahkan! ✨');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('icon')) {
            if ($program->icon) {
                Storage::disk('public')->delete($program->icon);
            }
            $data['icon'] = $request->file('icon')->store('program_icons', 'public');
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'Perubahan program disimpan! ✨');
    }

    public function destroy(Program $program)
    {
        if ($program->icon) {
            Storage::disk('public')->delete($program->icon);
        }
        $program->delete();

        return redirect()->route('admin.programs.index')->with('success', 'Program telah dihapus.');
    }


    // ==========================================
    // --- 2. RUTE PUBLIK (TAMPILAN USER) ---
    // ==========================================

    /**
     * Katalog Jenjang (Pilihan SD/SMP/SMA/SMK)
     */
    public function index_public()
    {
        $programs = Program::all();
        return view('programs.index', compact('programs'));
    }

    /**
     * Detail Jenjang (Menampilkan Daftar Mapel per Jenjang)
     */
    public function show($id)
    {
        $program = Program::with('subPrograms')->findOrFail($id);
        $programs = Program::all(); 
        return view('programs.show', compact('program', 'programs'));
    }

    /**
     * Detail Mata Pelajaran (Katalog Kuis, Tutor, Benefit)
     */
    public function katalog($id) 
    {
        $subProgram = SubProgram::with(['tutors', 'items', 'questions', 'benefits'])->findOrFail($id);
        $programs = Program::all();

        return view('katalog', [
            'selectedProgram' => $subProgram,
            'tutors'          => $subProgram->tutors,
            'programs'        => $programs 
        ]);
    }

    /**
     * PERBAIKAN: Fungsi Les Online (Publik) ✨
     * Menampilkan laman Les Online dengan data dinamis dari Admin
     */
    public function lesOnline()
    {
        // Data semua jenjang untuk navigasi dropdown di navbar
        $programs = Program::all(); 
        
        // Mengambil data pengaturan konten (Hero, Stats, Fitur) yang diinput Admin
        // keyBy('section') memudahkan pemanggilan di Blade: $onlineSettings['hero']
        $onlineSettings = OnlineSetting::all()->keyBy('section');

        return view('online', compact('programs', 'onlineSettings'));
    }
}