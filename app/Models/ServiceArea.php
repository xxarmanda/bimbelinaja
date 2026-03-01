<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceArea extends Model
{
    use HasFactory;

    // TAMBAHKAN KODE INI
    protected $fillable = [
        'city_name', 
        'description', 
        'icon', 
        'is_active'
    ];
}