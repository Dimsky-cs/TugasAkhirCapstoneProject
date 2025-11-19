<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('konselings', function (Blueprint $table) {
            // Rating bintang 1-5 (nullable karena belum diisi di awal)
            $table->tinyInteger('rating')->nullable()->after('psikolog_notes');
            // Komentar teks ulasan
            $table->text('review')->nullable()->after('rating');
        });
    }

    public function down()
    {
        Schema::table('konselings', function (Blueprint $table) {
            $table->dropColumn(['rating', 'review']);
        });
    }
};
