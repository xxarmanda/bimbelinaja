<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registration_steps', function (Blueprint $table) {
                $table->id();
                $table->string('title');       // Contoh: 1. Registrasi Online
                $table->text('description');   // Deskripsi langkahnya
                $table->string('icon');        // Nama icon atau path file icon
                $table->integer('order')->default(0); // Urutan tampil (1, 2, 3, 4)
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_steps');
    }
};
