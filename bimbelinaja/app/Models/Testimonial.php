<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    // Daftarkan SEMUA field agar bisa disimpan ke database
    // app/Models/Testimonial.php

protected $fillable = [
    'name',
    'title',      
    'message',
    'image',
    'duration',
];}