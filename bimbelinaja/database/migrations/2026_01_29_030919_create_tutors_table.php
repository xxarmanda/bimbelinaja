<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            // Sekarang ini aman karena tabel programs sudah dibuat di file tanggal 28
            $table->foreignId('program_id')->constrained()->onDelete('cascade'); 
            
            $table->string('name');
            $table->string('specialization');
            $table->text('bio')->nullable();
            $table->string('phone');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};