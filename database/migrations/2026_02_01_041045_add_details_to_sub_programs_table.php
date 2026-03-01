<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sub_programs', function (Blueprint $table) {
            // Deskripsi lengkap mata pelajaran
            $table->text('description')->nullable()->after('name');
            
            // Gambar sampul mata pelajaran
            $table->string('image')->nullable()->after('description');
            
            // Harga untuk melanjutkan ke bimbel (Technopreneurship mode)
            $table->decimal('price', 10, 2)->default(0)->after('image');
            
            // Kolom untuk menyimpan soal kuis gratis (Format JSON agar fleksibel)
            $table->longText('quiz_content')->nullable()->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('sub_programs', function (Blueprint $table) {
            $table->dropColumn(['description', 'image', 'price', 'quiz_content']);
        });
    }
};