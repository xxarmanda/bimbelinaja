<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('student_testimonials', function (Blueprint $table) {
            // Perintah untuk menghapus kolom youtube_id yang sudah ada tadi
            $table->dropColumn('youtube_id');
        });
    }

    public function down()
    {
        Schema::table('student_testimonials', function (Blueprint $table) {
            // Jika suatu saat mau ada youtube lagi, kodingan ini yang mengembalikan
            $table->string('youtube_id')->nullable()->after('image');
        });
    }
};