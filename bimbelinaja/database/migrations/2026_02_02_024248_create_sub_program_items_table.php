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
        Schema::create('sub_program_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('sub_program_id')->constrained()->onDelete('cascade'); // Menghubungkan ke mata pelajaran (misal: Coding)
                $table->string('name'); // Nama sub-program (misal: Builder Junior)
                $table->string('age_range'); // Rentang usia (misal: 3-7 tahun)
                $table->text('description'); // Deskripsi pendek
                $table->string('icon')->nullable(); // Emoji atau icon
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_program_items');
    }
};
