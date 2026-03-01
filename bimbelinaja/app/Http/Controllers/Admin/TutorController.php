<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Models\Program;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TutorController extends Controller
{
    public function index()
    {
        $tutors = Tutor::latest()->get();
        $settings = Setting::pluck('value', 'key')->all(); 
        return view('admin.tutors.index', compact('tutors', 'settings'));
    }

    public function create()
    {
        // PERBAIKAN: Ambil data program agar variabel $programs tersedia
        $programs = Program::all(); 
        return view('admin.tutors.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
            'program_id' => 'required|exists:programs,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('tutors', 'public');
        }

        Tutor::create($data);
        return redirect()->route('admin.tutors.index')->with('success', 'Tutor baru berhasil ditambahkan! ✨');
    }

    public function edit(Tutor $tutor)
    {
        // PERBAIKAN: Ambil data program agar variabel $programs tersedia
        $programs = Program::all(); 
        return view('admin.tutors.edit', compact('tutor', 'programs'));
    }

    public function update(Request $request, Tutor $tutor)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'program_id' => 'required|exists:programs,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($tutor->photo) {
                Storage::disk('public')->delete($tutor->photo);
            }
            $data['photo'] = $request->file('photo')->store('tutors', 'public');
        }

        $tutor->update($data);
        return redirect()->route('admin.tutors.index')->with('success', 'Data tutor berhasil diperbarui! ✨');
    }

    public function destroy(Tutor $tutor)
    {
        if ($tutor->photo) {
            Storage::disk('public')->delete($tutor->photo);
        }
        $tutor->delete();
        return redirect()->route('admin.tutors.index')->with('success', 'Tutor berhasil dihapus!');
    }

    public function katalog(Request $request)
    {
        $programId = $request->query('program');
        $selectedProgram = Program::find($programId);
        $query = Tutor::query();
        if ($programId) { $query->where('program_id', $programId); }
        $tutors = $query->get();
        return view('katalog', compact('tutors', 'selectedProgram'));
    }
}