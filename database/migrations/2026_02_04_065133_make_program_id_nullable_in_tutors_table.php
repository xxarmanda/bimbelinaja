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
    Schema::table('tutors', function (Blueprint $table) {
        // Mengubah kolom program_id agar boleh kosong (nullable)
        $table->unsignedBigInteger('program_id')->nullable()->change(); 
    });
}

public function down(): void
{
    Schema::table('tutors', function (Blueprint $table) {
        $table->unsignedBigInteger('program_id')->nullable(false)->change();
    });
}
};
