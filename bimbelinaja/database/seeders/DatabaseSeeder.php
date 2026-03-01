<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\OnlineSetting; // Tambahkan import model ini
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. TETAP PERTAHANKAN SUPER ADMIN KAMU
        User::updateOrCreate(
            ['email' => 'admin@bimbelinaja.com'], // Cek berdasarkan email agar tidak duplikat
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password123'),
                'role' => 1, // Set langsung jadi Admin
            ]
        );

        // 2. DATA KONTEN LAMAN LES ONLINE (Disesuaikan dengan Screenshot)
        $onlineData = [
            [
                'section' => 'hero',
                'title' => 'Les Privat Online & Interaktif',
                'description' => 'Hai Sobat Edufio, Apakah kamu ingin belajar online dengan dibimbing langsung oleh Tutor secara interaktif? Edufio menghadirkan program live tutoring yang memungkinkan kamu untuk belajar di Rumah.',
                'image' => 'online_page/hero.png'
            ],
            [
                'section' => 'stats',
                'title' => '3,770+',
                'description' => '5,859+',
                'image' => null
            ],
            [
                'section' => 'quote',
                'title' => 'Pembelajaran Online yang Dipersonalisasi',
                'description' => '“Setiap siswa membutuhkan dukungan pembelajaran yang sesuai untuk situasi atau konteks mereka. Pembelajaran online yang dipersonalisasi memungkinkan setiap siswa memperoleh pembelajaran yang sesuai konteks.” - Edufio Team',
                'image' => null
            ],
            // SEKSI FITUR UTAMA (ZIG-ZAG)
            [
                'section' => 'feature_1',
                'title' => 'Satu Guru Satu Murid',
                'description' => 'Program les privat online dirancang satu tutor satu siswa. Siswa akan dibimbing secara live dan mendapatkan perhatian sepenuhnya dari tutor.',
                'image' => 'online_page/feature1.png'
            ],
            [
                'section' => 'feature_2',
                'title' => 'Online & Interaktif',
                'description' => 'Kegiatan belajar dirancang interaktif. Siswa bisa berinteraksi langsung, bertanya jika tidak paham, dan tutor mengajar sesuai kecepatan belajar siswa.',
                'image' => 'online_page/feature2.png'
            ],
            [
                'section' => 'feature_3',
                'title' => 'Personalized Learning',
                'description' => 'Pembelajaran dipersonalisasi mengikuti kebutuhan dan preferensi belajar siswa. Tutor merancang KBM yang tepat sesuai kebutuhan unikmu.',
                'image' => 'online_page/feature3.png'
            ],
            // TAMBAHAN: SEKSI BENEFIT GRID (6 ITEM DARI SCREENSHOT)
            [
                'section' => 'benefit_1',
                'title' => 'Hemat Waktu',
                'description' => 'Hemat waktu anda dengan belajar secara online dengan tutor langsung',
                'image' => 'online_page/benefit1.png'
            ],
            [
                'section' => 'benefit_2',
                'title' => 'Hemat Biaya',
                'description' => 'Pangkas biaya transport dan biaya lainnya dengan belajar secara online',
                'image' => 'online_page/benefit2.png'
            ],
            [
                'section' => 'benefit_3',
                'title' => 'Sertifikat',
                'description' => 'Dapatkan sertifikat belajar online dengan request ke admin',
                'image' => 'online_page/benefit3.png'
            ],
            [
                'section' => 'benefit_4',
                'title' => 'Tutor Lengkap',
                'description' => 'Database tutor terlengkap di Jogja dengan berbagai keahlian',
                'image' => 'online_page/benefit4.png'
            ],
            [
                'section' => 'benefit_5',
                'title' => 'Program Lengkap',
                'description' => 'Program les privat online terlengkap dari A-Z',
                'image' => 'online_page/benefit5.png'
            ],
            [
                'section' => 'benefit_6',
                'title' => 'Dipersonalisasi',
                'description' => 'Pembelajaran dipersonalisasi dengan fitur live teaching & privat',
                'image' => 'online_page/benefit6.png'
            ],
        ];

        foreach ($onlineData as $item) {
            // updateOrCreate akan mengecek berdasarkan 'section' agar tidak duplikat
            OnlineSetting::updateOrCreate(['section' => $item['section']], $item);
        }
    }
}