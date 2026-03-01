<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentTestimonial extends Model
{
    // Arahkan ke tabel testimoni SISWA
    protected $table = 'student_testimonials';

    protected $fillable = [
        'name',
        'title',
        'message',
        'image',
    ];
}