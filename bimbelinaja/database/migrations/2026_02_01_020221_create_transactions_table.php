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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Sesuaikan 'programs' dengan nama tabel jenjang kamu di database
        $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
        
        $table->string('proof_file')->nullable();
        $table->decimal('amount', 10, 2);
        $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
