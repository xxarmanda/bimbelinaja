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
    Schema::create('service_areas', function (Blueprint $table) {
        $table->id();
        $table->string('city_name'); // Cirebon, dll
        $table->text('description'); // Daftar kecamatan/wilayah
        $table->string('icon')->nullable(); // Ikon pin map
        $table->boolean('is_active')->default(true);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_areas');
    }
};
