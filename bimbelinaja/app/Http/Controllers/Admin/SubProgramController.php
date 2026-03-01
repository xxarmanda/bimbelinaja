<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubProgram;
use App\Models\Program;
use App\Models\SubProgramItem;
use App\Models\SubProgramBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubProgramController extends Controller
{
    /**
     * Menampilkan daftar semua mata pelajaran.
     */
    public function index()
    {
        $subPrograms = SubProgram::with('program')->latest()->get();
        return view('admin.sub_programs.index', compact('subPrograms'));
    }

    /**
     * Menampilkan form tambah mata pelajaran baru.
     */
    public function create()
    {
        $programs = Program::all();
        return view('admin.sub_programs.create', compact('programs'));
    }

    /**
     * Menyimpan data mata pelajaran baru.
     */
    public function store(Request $request)
    {
        // 1. SMART PRICE CLEANER: Menghapus titik/koma agar menjadi angka murni sebelum divalidasi
        if ($request->has('price')) {
            $cleanPrice = preg_replace('/[^0-9]/', '', $request->price);
            $request->merge(['price' => $cleanPrice]);
        }

        $request->validate([
            'program_id'   => 'required|exists:programs,id',
            'name'         => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'image'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('sub_programs', 'public');

        $subProgram = SubProgram::create([
            'program_id'   => $request->program_id,
            'name'         => $request->name,
            'description'  => $request->description ?? '-',
            'price'        => $request->price,
            'image'        => $imagePath,
        ]);

        // Simpan Kartu Level Baru
        if ($request->filled('new_item_name')) {
            $iconPath = $request->hasFile('new_item_icon') ? $request->file('new_item_icon')->store('sub_program_items', 'public') : null;
            $subProgram->items()->create([
                'name'        => $request->new_item_name, 
                'age_range'   => $request->new_item_age ?? '-', 
                'icon'        => $iconPath, 
                'description' => $request->new_item_desc ?? '-' 
            ]);
        }

        // Simpan Manfaat Baru
        if ($request->filled('new_benefit_title')) {
            $subProgram->benefits()->create([
                'title'       => $request->new_benefit_title, 
                'description' => $request->new_benefit_desc ?? '-'
            ]);
        }

        // Simpan Kuis Baru
        if ($request->has('questions') && is_array($request->questions)) {
            foreach ($request->questions as $q) {
                if (!empty($q['question_text'])) {
                    $subProgram->questions()->create($q);
                }
            }
        }

        return redirect()->route('admin.sub-programs.index')->with('success', 'Mata Pelajaran Berhasil Dibuat! ✨');
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(SubProgram $subProgram)
    {
        $programs = Program::all();
        $subProgram->load(['items', 'benefits', 'questions']); 
        return view('admin.sub_programs.edit', compact('subProgram', 'programs'));
    }

    /**
     * Memperbarui data mata pelajaran (FIXED VERSION)
     */
    public function update(Request $request, SubProgram $subProgram)
    {
        // 1. SMART PRICE CLEANER: Membersihkan "300.000" menjadi "300000"
        if ($request->has('price')) {
            $cleanPrice = preg_replace('/[^0-9]/', '', $request->price);
            $request->merge(['price' => $cleanPrice]);
        }

        // 2. VALIDASI: Pastikan format harga sudah numeric
        $request->validate([
            'program_id'    => 'required|exists:programs,id',
            'name'          => 'required|string|max:255',
            'price'         => 'required|numeric|min:0',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'new_item_icon' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $data = $request->only(['program_id', 'name', 'description', 'price']);

        // Handle Update Gambar Utama
        if ($request->hasFile('image')) {
            if ($subProgram->image) { Storage::disk('public')->delete($subProgram->image); }
            $data['image'] = $request->file('image')->store('sub_programs', 'public');
        }

        // Jalankan Update Data Utama
        $subProgram->update($data);

        // 3. PROSES DATA TAMBAHAN SAAT EDIT (LEVEL & MANFAAT)
        
        // Tambah Item/Level Baru (Fallback ke '-' jika kosong)
        if ($request->filled('new_item_name')) {
            $iconPath = $request->hasFile('new_item_icon') ? $request->file('new_item_icon')->store('sub_program_items', 'public') : null;
            $subProgram->items()->create([
                'name'        => $request->new_item_name, 
                'age_range'   => $request->new_item_age ?? '-', 
                'icon'        => $iconPath, 
                'description' => $request->new_item_desc ?? '-'
            ]);
        }
        
        // Tambah Manfaat Baru
        if ($request->filled('new_benefit_title')) {
            $subProgram->benefits()->create([
                'title'       => $request->new_benefit_title, 
                'description' => $request->new_benefit_desc ?? '-'
            ]);
        }
        
        // Tambah Kuis Baru
        if ($request->has('questions') && is_array($request->questions)) {
            foreach ($request->questions as $q) {
                if (!empty($q['question_text'])) {
                    $subProgram->questions()->create($q);
                }
            }
        }

        // 4. PINDAH KE INDEX: Pastikan redirect ke halaman daftar
        return redirect()->route('admin.sub-programs.index')->with('success', 'Mata Pelajaran ' . $subProgram->name . ' Berhasil Diperbarui! ✨');
    }

    /**
     * Hapus mata pelajaran.
     */
    public function destroy(SubProgram $subProgram)
    {
        if ($subProgram->image) { Storage::disk('public')->delete($subProgram->image); }
        foreach ($subProgram->items as $item) { 
            if ($item->icon) { Storage::disk('public')->delete($item->icon); } 
        }
        $subProgram->delete();
        return redirect()->route('admin.sub-programs.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }

    public function destroyItem($id) {
        $item = SubProgramItem::findOrFail($id);
        if ($item->icon) { Storage::disk('public')->delete($item->icon); }
        $item->delete(); 
        return back()->with('success', 'Kartu level berhasil dihapus.');
    }

    public function destroyBenefit($id) {
        SubProgramBenefit::findOrFail($id)->delete(); 
        return back()->with('success', 'Manfaat berhasil dihapus.');
    }
}