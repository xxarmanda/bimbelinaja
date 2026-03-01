<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    // Mengizinkan penyimpanan data soal kuis internal
    protected $fillable = [
        'sub_program_id', 
        'question_text', 
        'option_a', 
        'option_b', 
        'option_c', 
        'option_d', 
        'correct_answer'
    ];

    /**
     * Relasi balik: Menghubungkan soal ke Mata Pelajaran tertentu
     */
    public function subProgram(): BelongsTo
    {
        return $this->belongsTo(SubProgram::class);
    }
}