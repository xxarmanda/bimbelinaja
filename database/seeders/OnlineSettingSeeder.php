<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OnlineSetting; // Memanggil model OnlineSetting

class OnlineSettingSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'section' => 'hero',
                'title' => 'Les Privat Online & Interaktif',
                'description' => 'Hai Sobat Edufio, Apakah kamu ingin belajar online dengan dibimbing langsung oleh Tutor secara interaktif? Edufio menghadirkan program live tutoring yang memungkinkan kamu untuk belajar di Rumah.',
                'image' => 'online_page/hero.png'
            ],
            [
                'section' => 'quote',
                'title' => 'Pembelajaran Online yang Dipersonalisasi',
                'description' => '“Setiap siswa membutuhkan dukungan pembelajaran yang sesuai untuk situasi atau konteks mereka. Pembelajaran online yang dipersonalisasi memungkinkan setiap siswa memperoleh pembelajaran yang sesuai konteks.” - Edufio Team',
                'image' => null
            ],
            [
                'section' => 'stats',
                'title' => '3,770+',
                'description' => '5,859+',
                'image' => null
            ],
            // 5. BENEFITS GRID (6 ITEMS)
            [
                'section' => 'benefit_1',
                'title' => 'Hemat Waktu',
                'description' => 'Hemat waktu anda dengan belajar secara online dengan tutor langsung',
                'image' => 'online_page/icon1.png'
            ],
            [
                'section' => 'benefit_2',
                'title' => 'Hemat Biaya',
                'description' => 'Pangkas biaya transport dan biaya lainnya dengan belajar secara online',
                'image' => 'online_page/icon2.png'
            ],
            [
                'section' => 'benefit_3',
                'title' => 'Sertifikat',
                'description' => 'Dapatkan sertifikat belajar online dengan request ke admin',
                'image' => 'online_page/icon3.png'
            ],
            [
                'section' => 'benefit_4',
                'title' => 'Tutor Lengkap',
                'description' => 'Database tutor terlengkap di Jogja dengan berbagai keahlian',
                'image' => 'online_page/icon4.png'
            ],
            [
                'section' => 'benefit_5',
                'title' => 'Program Lengkap',
                'description' => 'Program les privat online terlengkap dari A-Z',
                'image' => 'online_page/icon5.png'
            ],
            [
                'section' => 'benefit_6',
                'title' => 'Dipersonalisasi',
                'description' => 'Pembelajaran dipersonalisasi dengan fitur live teaching & privat',
                'image' => 'online_page/icon6.png'
            ],
        ];

        foreach ($data as $item) {
            OnlineSetting::updateOrCreate(['section' => $item['section']], $item);
        }
    }
}