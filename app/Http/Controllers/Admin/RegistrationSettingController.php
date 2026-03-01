<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class RegistrationSettingController extends Controller
{
    public function update(Request $request)
    {
        $data = [
            'registration_title',
            'registration_brand',
            'registration_subtitle'
        ];

        foreach ($data as $key) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $request->$key]
            );
        }

        return back()->with('success','Teks pendaftaran berhasil diperbarui');
    }
}