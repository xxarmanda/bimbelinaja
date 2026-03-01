<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'guest_name',
        'guest_email',
        'program_id',
        'sub_program_id',

        // ===== FIELD YANG KAMU BUTUHKAN UNTUK REKAP =====
        'learning_method',
        'sessions',
        'participants_count',

        'amount',
        'status',
        'proof_of_payment',
        'notes'
    ];

    protected $casts = [
        'notes' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function subProgram() {
        return $this->belongsTo(SubProgram::class, 'sub_program_id');
    }
}