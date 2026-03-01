<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
    Schema::create('online_settings', function (Blueprint $table) {
        $table->id();
        $table->string('section')->unique(); // Contoh: 'hero', 'quote', 'feature_1'
        $table->string('title')->nullable();
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_settings');
    }
};
