<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('payment_configs', function (Blueprint $table) {
        $table->id();
        $table->string('bank_name')->default('BANK BCA'); //
        $table->string('bank_account')->default('123-4567-890'); //
        $table->string('bank_owner')->default('A.N. BIMBELINAJA SIGNATURE'); //
        $table->integer('registration_fee')->default(95000); //
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_configs');
    }
};
