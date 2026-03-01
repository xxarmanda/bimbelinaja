<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    // Hanya kolom ini yang boleh diisi melalui form
    protected $fillable = [
            'name',
            'role',
            'photo',
            'program_id'
    ];

    /**
     * Catatan RPL 3D: 
     * Jika di formulir kamu (image_1a9dbb.png) tidak ada pilihan Jenjang/Program,
     * maka relasi di bawah ini akan menghasilkan null saat dipanggil.
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}