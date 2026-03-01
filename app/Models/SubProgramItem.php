<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubProgramItem extends Model
{
    // FIX: Daftarkan semua kolom agar bisa diisi (Mass Assignment)
    protected $fillable = [
        'sub_program_id', 
        'name', 
        'age_range', 
        'icon', 
        'description'
    ];

    /**
     * Relasi balik: Item level ini milik Mata Pelajaran apa?
     */
    public function subProgram(): BelongsTo
    {
        return $this->belongsTo(SubProgram::class);
    }
}