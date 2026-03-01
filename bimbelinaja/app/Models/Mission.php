<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    /**
     * Properti fillable untuk mengizinkan mass assignment.
     * Masukkan semua kolom yang kamu buat di file migrasi tadi.
     */
    protected $fillable = [
        'title', 
        'description',
        'icon', // Masukkan juga jika kamu berencana menggunakan ikon nanti
    ];
}