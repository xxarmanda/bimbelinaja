<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Tambahkan field yang sesuai dengan input di Controller kamu
    protected $fillable = [
        'user_id', 
        'guest_name',       // TAMBAHAN: Agar nama tamu tersimpan
        'guest_email',      // TAMBAHAN: Agar email tamu tersimpan
        'program_id', 
        'sub_program_id', 
        'amount', 
        'status', 
        'proof_of_payment',
        'notes'             // TAMBAHAN: Agar data JSON detail siswa tersimpan
    ];

    // Relasi ke User (Jika user sudah login)
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Jenjang/Program (Parent)
    public function program() {
        return $this->belongsTo(Program::class);
    }

    // Relasi ke Mata Pelajaran (Sub Program)
    public function subProgram() {
        return $this->belongsTo(SubProgram::class, 'sub_program_id');
    }
}