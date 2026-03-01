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
    Schema::table('student_testimonials', function (Blueprint $table) {
        // Menambahkan kolom youtube_id setelah kolom image
        $table->string('youtube_id')->nullable()->after('image');
    });
}

public function down()
{
    Schema::table('student_testimonials', function (Blueprint $table) {
        $table->dropColumn('youtube_id');
    });
}
};
