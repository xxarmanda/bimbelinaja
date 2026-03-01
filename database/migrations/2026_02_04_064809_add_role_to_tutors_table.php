<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan Migrasi
     */
    public function up(): void
    {
        Schema::table('tutors', function (Blueprint $table) {
            // 1. Menambahkan kolom role (yang sudah ada sebelumnya)
            if (!Schema::hasColumn('tutors', 'role')) {
                $table->string('role')->after('name')->nullable(); 
            }

            // 2. TAMBAHKAN INI: Menghubungkan Tutor ke Program/Jenjang
            if (!Schema::hasColumn('tutors', 'program_id')) {
                $table->foreignId('program_id')
                      ->after('role') // Letakkan setelah kolom role
                      ->nullable()    // Beri nullable dulu agar data lama tidak error
                      ->constrained() // Otomatis konek ke tabel 'programs'
                      ->onDelete('cascade'); // Jika program dihapus, tutor ikut terhapus
            }
        });
    }

    /**
     * Batalkan Migrasi
     */
    public function down(): void
    {
        Schema::table('tutors', function (Blueprint $table) {
            // Drop foreign key dulu baru drop kolomnya
            $table->dropForeign(['program_id']);
            $table->dropColumn(['role', 'program_id']);
        });
    }
};