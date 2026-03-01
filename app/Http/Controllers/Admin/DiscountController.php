<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::latest()->get();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('admin.discounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('discounts', 'public');
        }

        Discount::create($data);

        return redirect()->route('discounts.index')->with('success', 'Promo berhasil di-upload!');
    }

    public function destroy(Discount $discount)
    {
        if ($discount->banner_image) {
            Storage::disk('public')->delete($discount->banner_image);
        }
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Promo berhasil dihapus!');
    }
}