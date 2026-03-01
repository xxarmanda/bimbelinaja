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
        Schema::create('missions', function (Blueprint $table) {
                $table->id();
                $table->string('title');       // Contoh: TUTOR BERKUALITAS
                $table->text('description');   // Penjelasan misinya
                $table->string('icon')->nullable(); // Ikon (Buku, Laptop, dsb)
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
