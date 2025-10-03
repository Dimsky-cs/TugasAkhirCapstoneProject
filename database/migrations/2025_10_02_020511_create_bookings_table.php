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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // user yang booking
        $table->string('layanan');             // jenis layanan konseling
        $table->string('konselor');            // konselor yang dipilih
        $table->date('tanggal');               // tanggal booking
        $table->time('waktu');                 // jam booking
        $table->string('metode');              // metode konseling
        $table->string('nama');                // nama lengkap klien
        $table->string('email');
        $table->string('telepon');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
