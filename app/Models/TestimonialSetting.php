<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialSetting extends Model
{
    use HasFactory;

    protected $table = 'testimonial_settings';

    protected $fillable = [
        'title',
        'subtitle',
    ];
}