<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('konselings', function (Blueprint $table) {
            // Menambah kolom link meeting (bisa null jika belum dikonfirmasi)
            $table->string('meeting_link')->nullable()->after('status');

            // Menambah catatan psikolog (opsional, diisi setelah sesi selesai)
            $table->text('psikolog_notes')->nullable()->after('meeting_link');
        });
    }

    public function down()
    {
        Schema::table('konselings', function (Blueprint $table) {
            $table->dropColumn(['meeting_link', 'psikolog_notes']);
        });
    }
};
