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
    Schema::table('sub_programs', function (Blueprint $table) {
        // Cek dulu, kalau belum ada kolom 'description', baru buat
        if (!Schema::hasColumn('sub_programs', 'description')) {
            $table->text('description')->nullable();
        }
        
        // Cek juga untuk kolom lainnya biar tidak duplikat
        if (!Schema::hasColumn('sub_programs', 'price')) {
            $table->integer('price')->default(0);
        }

        if (!Schema::hasColumn('sub_programs', 'trial_link')) {
            $table->string('trial_link')->nullable();
        }

        if (!Schema::hasColumn('sub_programs', 'image')) {
            $table->string('image')->nullable();
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_programs', function (Blueprint $table) {
            //
        });
    }
};
