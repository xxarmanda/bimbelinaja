<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubProgramBenefit extends Model
{
    // Kolom yang diizinkan untuk diisi oleh Admin
    protected $fillable = [
        'sub_program_id', 
        'title', 
        'description'
    ];

    /**
     * Relasi balik ke Mata Pelajaran
     */
    public function subProgram(): BelongsTo
    {
        return $this->belongsTo(SubProgram::class);
    }
}