<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubProgramItem;
use Illuminate\Support\Facades\Storage;

class SubProgramItemController extends Controller
{
    public function destroy(SubProgramItem $subProgramItem)
    {
        // 1. Hapus file gambar dari storage jika ada
        if ($subProgramItem->icon && Storage::disk('public')->exists($subProgramItem->icon)) {
            Storage::disk('public')->delete($subProgramItem->icon);
        }

        // 2. Hapus data dari database
        $subProgramItem->delete();

        // 3. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Kartu level berhasil dihapus!');
    }
}