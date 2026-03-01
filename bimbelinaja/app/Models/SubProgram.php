<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// IMPORT SEMUA MODEL DI SINI AGAR TIDAK MERAH
use App\Models\Program;
use App\Models\Tutor;
use App\Models\SubProgramItem;
use App\Models\SubProgramBenefit;
use App\Models\Question;

class SubProgram extends Model
{
    protected $fillable = [
        'program_id', 
        'name', 
        'description', 
        'price', 
        'trial_link', 
        'image'
    ];

    /**
     * Menghubungkan ke Jenjang Utama (SD, SMP, atau SMA)
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Menghubungkan ke daftar Tutor yang mengajar mapel ini
     */
    public function tutors(): HasMany
    {
        return $this->hasMany(Tutor::class);
    }

    /**
     * Menghubungkan ke kartu-kartu level (Builder Junior, Creative Maker, dll)
     */
    public function items(): HasMany
    {
        return $this->hasMany(SubProgramItem::class);
    }

    /**
     * Menghubungkan ke daftar manfaat belajar
     */
    public function benefits(): HasMany
    {
        return $this->hasMany(SubProgramBenefit::class);
    }

    /**
     * Menghubungkan ke soal-soal kuis internal BimbelinAja
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}