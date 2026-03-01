<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Kolom yang dapat diisi secara massal.
     * Sebagai standar RPL, ini wajib ada untuk keamanan data.
     */
    protected $fillable = [
        'key', 
        'value'
    ];
}