<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    // Mengizinkan kolom ini diisi secara massal (Mass Assignment)
    protected $fillable = [
        'name',
        'email',
        'message',
        'is_read'
    ];
}