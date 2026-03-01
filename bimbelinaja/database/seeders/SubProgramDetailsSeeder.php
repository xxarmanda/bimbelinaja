<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubProgramItem;
use App\Models\SubProgramBenefit;

class SubProgramDetailsSeeder extends Seeder
{
    public function run(): void
    {
        // Ganti angka 13 dengan ID Mata Pelajaran yang ingin kamu isi datanya
        $idMapel = 14; 

        // 1. Data Sub-Program (Kartu-Kartu Level)
        SubProgramItem::create([
            'sub_program_id' => $idMapel,
            'name'           => 'Builder Junior',
            'age_range'      => '3-7 Tahun',
            'icon'           => '🎓',
            'description'    => 'Anak belajar dasar pemrograman secara visual melalui animasi dan game sederhana.'
        ]);

        SubProgramItem::create([
            'sub_program_id' => $idMapel,
            'name'           => 'Creative Maker',
            'age_range'      => '7-12 Tahun',
            'icon'           => '🐱',
            'description'    => 'Memungkinkan anak belajar membuat animasi, game, dan cerita digital dengan platform Scratch.'
        ]);

        SubProgramItem::create([
            'sub_program_id' => $idMapel,
            'name'           => 'Game Developer',
            'age_range'      => '10-16 Tahun',
            'icon'           => '🎮',
            'description'    => 'Membuat game 3D profesional menggunakan bahasa pemrograman nyata untuk melatih logika.'
        ]);

        // 2. Data Manfaat Belajar
        SubProgramBenefit::create([
            'sub_program_id' => $idMapel,
            'title'          => 'Meningkatkan Kemampuan Pemecahan Masalah',
            'description'    => 'Siswa belajar cara melihat masalah secara sistematis dan logis.'
        ]);

        SubProgramBenefit::create([
            'sub_program_id' => $idMapel,
            'title'          => 'Meningkatkan Kreativitas',
            'description'    => 'Memberikan platform bagi anak untuk mengekspresikan ide-ide unik mereka.'
        ]);
    }
}