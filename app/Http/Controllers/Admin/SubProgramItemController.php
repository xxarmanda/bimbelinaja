<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubProgramItem;
use Illuminate\Support\Facades\File;

class SubProgramItemController extends Controller
{
    public function destroy(SubProgramItem $subProgramItem)
    {
        if ($subProgramItem->icon && File::exists(public_path($subProgramItem->icon))) {
            File::delete(public_path($subProgramItem->icon));
        }

        $subProgramItem->delete();

        return back()->with('success', 'Kartu level berhasil dihapus!');
    }
}