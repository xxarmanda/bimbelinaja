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
        // Cek dulu apakah kolom role sudah ada, kalau belum buat baru
        if (!Schema::hasColumn('tutors', 'role')) {
            $table->string('role')->after('name')->nullable();
        }

        // Buat SEMUA kolom lama menjadi boleh kosong agar tidak error lagi
        $table->unsignedBigInteger('program_id')->nullable()->change();
        $table->string('specialization')->nullable()->change();
        $table->string('phone')->nullable()->change();
        $table->text('bio')->nullable()->change();
        $table->string('experience')->nullable()->change();
    });
}
};
