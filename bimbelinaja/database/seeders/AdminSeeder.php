<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    \App\Models\User::create([
        'name' => 'Super Admin',
        'email' => 'admin@bimbelinaja.com', // Email khusus admin
        'password' => bcrypt('AdminRahasia123'), // Password admin
        'role' => 1, // Penanda Admin
    ]);
    }
}
