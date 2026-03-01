<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaCoverage extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     */
    protected $fillable = [
        'name',      // Nama Media (IDN Times, Tribun, dll)
        'logo',      // File Logo Media
        'url',       // Link Berita
        'is_active'  // Status Aktif
    ];
}