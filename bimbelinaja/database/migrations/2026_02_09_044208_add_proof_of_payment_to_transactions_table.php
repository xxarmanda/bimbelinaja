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
        // Menambahkan kolom untuk menyimpan path/lokasi foto bukti transfer
        $table->string('proof_of_payment')->nullable()->after('notes');
        });
    }

public function down(): void
    {
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn('proof_of_payment');
        });
    }
};
