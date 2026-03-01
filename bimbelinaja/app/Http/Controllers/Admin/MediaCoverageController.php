<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaCoverage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaCoverageController extends Controller {
    public function index() {
        $medias = MediaCoverage::latest()->get();
        return view('admin.media_coverages.index', compact('medias'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|max:1024',
            'url'  => 'nullable|url'
        ]);

        $data['logo'] = $request->file('logo')->store('media_logos', 'public');
        MediaCoverage::create($data);

        return back()->with('success', 'Logo Media Berhasil Ditambah! 📰');
    }

    public function edit(MediaCoverage $media_coverage) {
        return view('admin.media_coverages.edit', compact('media_coverage'));
    }

    public function update(Request $request, MediaCoverage $media_coverage) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:1024',
            'url'  => 'nullable|url'
        ]);

        if ($request->hasFile('logo')) {
            if ($media_coverage->logo) Storage::disk('public')->delete($media_coverage->logo);
            $data['logo'] = $request->file('logo')->store('media_logos', 'public');
        }

        $media_coverage->update($data);
        return redirect()->route('admin.media-coverages.index')->with('success', 'Data Media Diperbarui!');
    }

    public function destroy(MediaCoverage $media_coverage) {
        if ($media_coverage->logo) Storage::disk('public')->delete($media_coverage->logo);
        $media_coverage->delete();
        return back()->with('success', 'Media dihapus.');
    }
}