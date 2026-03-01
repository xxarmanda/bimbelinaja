<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentConfig extends Model
{
    use HasFactory;

    // Pastikan kolom ini sesuai dengan yang kita buat di migrasi
    protected $fillable = [
        'bank_name',
        'bank_account',
        'bank_owner',
        'registration_fee'
    ];
}