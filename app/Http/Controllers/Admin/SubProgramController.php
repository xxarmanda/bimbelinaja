<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubProgram;
use App\Models\Program;
use App\Models\SubProgramItem;
use App\Models\SubProgramBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Menggunakan File facade untuk manajemen folder fisik

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

        // LOGIKA UPLOAD KE PUBLIC/UPLOADS (Tanpa Simling)
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'sub_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // Folder tujuan yang BENAR
            $targetFolder = public_path('uploads/sub_programs');

            // Buat folder jika belum ada
            if (!File::isDirectory($targetFolder)) {
                File::makeDirectory($targetFolder, 0755, true);
            }

            $file->move($targetFolder, $filename);

            // Path yang disimpan ke DB
            $imagePath = 'uploads/sub_programs/' . $filename;
        }

        $subProgram = SubProgram::create([
            'program_id'   => $request->program_id,
            'name'         => $request->name,
            'description'  => $request->description ?? '-',
            'price'        => $request->price,
            'image'        => $imagePath,
        ]);

        // Simpan Kartu Level Baru ke uploads/sub_program_items
        if ($request->filled('new_item_name')) {
            $iconPath = null;
            if ($request->hasFile('new_item_icon')) {
                $file = $request->file('new_item_icon');
                $filename = 'item_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $targetFolder = public_path('uploads/sub_program_items');
                
                if (!File::isDirectory($targetFolder)) {
                    File::makeDirectory($targetFolder, 0777, true, true);
                }

                $file->move($targetFolder, $filename);
                $iconPath = 'uploads/sub_program_items/' . $filename;
            }

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
     * Hapus mata pelajaran dan file fisiknya dari folder uploads.
     */
    public function destroy(SubProgram $subProgram)
    {
        // Hapus file fisik gambar utama dari uploads
        if ($subProgram->image && File::exists(public_path($subProgram->image))) { 
            File::delete(public_path($subProgram->image)); 
        }

        // Hapus file fisik ikon level dari uploads
        foreach ($subProgram->items as $item) { 
            if ($item->icon && File::exists(public_path($item->icon))) { 
                File::delete(public_path($item->icon)); 
            } 
        }

        $subProgram->delete();
        return redirect()->route('admin.sub-programs.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }

    /**
     * Hapus Item/Kartu Level secara fisik.
     */
    public function destroyItem($id) {
        $item = SubProgramItem::findOrFail($id);
        if ($item->icon && File::exists(public_path($item->icon))) { 
            File::delete(public_path($item->icon)); 
        }
        $item->delete(); 
        return back()->with('success', 'Kartu level berhasil dihapus.');
    }

    /**
     * Hapus Manfaat.
     */
    public function destroyBenefit($id) {
        SubProgramBenefit::findOrFail($id)->delete(); 
        return back()->with('success', 'Manfaat berhasil dihapus.');
    }
}