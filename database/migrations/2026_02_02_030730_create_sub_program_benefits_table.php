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
        Schema::create('sub_program_benefits', function (Blueprint $table) {
                $table->id();
                // Menghubungkan manfaat ke mata pelajaran tertentu
                $table->foreignId('sub_program_id')->constrained()->onDelete('cascade'); 
                $table->string('title'); // Contoh: Meningkatkan Kreativitas
                $table->text('description'); // Penjelasan manfaatnya
                $table->timestamps();
                });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_program_benefits');
    }
};
