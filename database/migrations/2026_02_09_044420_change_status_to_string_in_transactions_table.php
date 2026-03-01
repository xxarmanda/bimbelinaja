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
    Schema::table('transactions', function (Blueprint $table) {
        // Mengubah tipe data dari ENUM ke String agar bisa menerima 'waiting'
        $table->string('status')->default('pending')->change();
        });
    }

public function down(): void
    {
    Schema::table('transactions', function (Blueprint $table) {
        // Jika ingin dikembalikan ke ENUM (sesuaikan dengan pilihan awalmu)
        $table->enum('status', ['pending', 'success', 'failed'])->default('pending')->change();
        });
    }
};
