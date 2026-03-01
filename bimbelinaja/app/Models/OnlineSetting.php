<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineSetting extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     * Sesuai dengan struktur tabel online_settings kamu.
     */
    protected $fillable = [
        'section',     // Nama bagian (hero, stats, feature_1, dll)
        'title',       // Judul konten
        'description', // Isi teks/deskripsi
        'image',       // Path gambar atau ikon
    ];
}