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
                // Hanya buat kolom 'bio' jika belum ada
                if (!Schema::hasColumn('tutors', 'bio')) {
                    $table->text('bio')->nullable()->after('specialization');
                }
                
                // Hanya buat kolom 'experience' jika belum ada
                if (!Schema::hasColumn('tutors', 'experience')) {
                    $table->text('experience')->nullable()->after('bio');
                }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tutors', function (Blueprint $table) {
            //
        });
    }
};
