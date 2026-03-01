<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\RegistrationStep;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        $video = Setting::where('key', 'youtube_video_id')->first() ?: new Setting(['value' => null]);
        $steps = RegistrationStep::orderBy('order')->get();

        return view('admin.settings.index', compact('settings', 'video', 'steps'));
    }

    public function contactIndex()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.contact.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // About
            'about_label' => 'nullable|string',
            'about_title' => 'nullable|string',
            'about_desc_1' => 'nullable|string',
            'about_desc_2' => 'nullable|string',

            // Hero
            'hero_label'  => 'nullable|string',
            'hero_title'  => 'nullable|string',
            'hero_desc'   => 'nullable|string',

            // Tutor Section
            'tutor_label' => 'nullable|string',
            'tutor_title' => 'nullable|string',
            'tutor_desc'  => 'nullable|string',

            // Registration
            'registration_title' => 'nullable|string',
            'registration_brand' => 'nullable|string',
            'registration_subtitle' => 'nullable|string',
            'vision_text' => 'nullable|string',

            // Contact
            'contact_hero_title' => 'nullable|string',
            'contact_hero_subtitle' => 'nullable|string',
            'contact_support_title' => 'nullable|string',
            'contact_chat_title' => 'nullable|string',
            'contact_chat_desc' => 'nullable|string',
            'contact_mon_fri' => 'nullable|string',
            'contact_sat' => 'nullable|string',
            'contact_sun' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'contact_map_url' => 'nullable|string',
            'contact_map_embed' => 'nullable|string',

            // Career Lama
            'career_why_title' => 'nullable|string',
            'career_f1_title' => 'nullable|string',
            'career_f1_desc' => 'nullable|string',
            'career_f2_title' => 'nullable|string',
            'career_f2_desc' => 'nullable|string',
            'career_criteria_title' => 'nullable|string',
            'career_c1' => 'nullable|string',
            'career_c2' => 'nullable|string',
            'career_c3' => 'nullable|string',
            'career_c4' => 'nullable|string',
            'career_cta_title' => 'nullable|string',
            'career_cta_desc' => 'nullable|string',
            'career_step_1' => 'nullable|string',
            'career_step_2' => 'nullable|string',
            'career_step_3' => 'nullable|string',
            'career_whatsapp_url' => 'nullable|string',

            // ✅ TAMBAHAN — CAREER HEADER & BENEFIT (INI YANG KEMARIN KURANG)
            'career_title' => 'nullable|string',
            'career_brand' => 'nullable|string',
            'career_slogan' => 'nullable|string',
            'career_benefit_title' => 'nullable|string',
            'career_benefit_brand' => 'nullable|string',
            'career_benefit_subtitle' => 'nullable|string',

            // Youtube
            'youtube_url' => 'nullable|string',
        ]);

        // HANDLE YOUTUBE
        if ($request->filled('youtube_url')) {
            $url = $request->youtube_url;
            $videoId = $url;

            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                $videoId = $match[1];
            }

            Setting::updateOrCreate(
                ['key' => 'youtube_video_id'],
                ['value' => $videoId]
            );
        }

        // SIMPAN SEMUA TEXT FIELD
        $textFields = $request->except(['_token', '_method', 'youtube_url']);

        foreach ($textFields as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()
            ->with('success', 'Pengaturan berhasil diperbarui! ✨');
    }

    public function destroyVideo()
    {
        $setting = Setting::where('key', 'youtube_video_id')->first();

        if ($setting) {
            $setting->update(['value' => null]);
        }

        return redirect()->back()
            ->with('success', 'Video berhasil dihapus!');
    }
}