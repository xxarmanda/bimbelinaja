<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationStep extends Model
{
    /**
     * Izinkan kolom-kolom ini untuk diisi secara massal
     */
    protected $fillable = [
        'title', 
        'description', 
        'icon', 
        'order'
    ];
}