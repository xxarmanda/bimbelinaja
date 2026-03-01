<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'icon', 
        'description', 
        'is_active'
    ];

    /**
     * Menghubungkan Jenjang ke banyak Mata Pelajaran (Sub Programs)
     * PENTING: Mendefinisikan 'program_id' secara manual untuk akurasi database
     */
    public function subPrograms(): HasMany
    {
        return $this->hasMany(SubProgram::class, 'program_id');
    }
}