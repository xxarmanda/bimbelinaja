<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
    {
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('media_coverages', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama Media (IDN Times, dll)
        $table->string('logo'); // File gambar logo
        $table->string('url')->nullable(); // Link berita (opsional)
        $table->boolean('is_active')->default(true);
        $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_coverages');
    }
};
