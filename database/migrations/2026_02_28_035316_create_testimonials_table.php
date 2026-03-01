<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Bukan 'nama'
            $table->string('title');         // Bukan 'kategori'
            $table->text('testimony');       // Bukan 'pesan'
            $table->string('image');         // Bukan 'foto'
            $table->boolean('is_active')->default(true); // Kolom status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
