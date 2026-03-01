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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('banner_image'); // Foto promo
            $table->string('title');        // Judul diskon
            $table->text('description');    // Deskripsi/Syarat
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
};
