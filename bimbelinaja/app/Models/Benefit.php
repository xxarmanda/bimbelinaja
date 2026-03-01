<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    // Tambahkan 'image' agar foto bisa tersimpan di database
    protected $fillable = ['title', 'description', 'image', 'icon'];
}