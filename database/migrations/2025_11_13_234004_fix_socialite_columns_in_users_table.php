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
        Schema::table('users', function (Blueprint $table) {

            // Cek 1: Apakah 'provider_name' ada? Jika TIDAK, tambahkan.
            if (!Schema::hasColumn('users', 'provider_name')) {
                $table->string('provider_name')->nullable()->after('password');
            }

            // Cek 2: Apakah 'provider_id' ada? Jika TIDAK, tambahkan.
            // (Menurut error-mu, ini akan di-skip, dan itu bagus)
            if (!Schema::hasColumn('users', 'provider_id')) {
                $table->string('provider_id')->nullable()->after('provider_name');
            }

            // Cek 3: Apakah 'provider_avatar' ada? Jika TIDAK, tambahkan.
            // (Ini yang jadi sumber error di controller)
            if (!Schema::hasColumn('users', 'provider_avatar')) {
                // Pastikan 'provider_id' ada sebelum menaruh 'after'
                $afterColumn = Schema::hasColumn('users', 'provider_id') ? 'provider_id' : 'provider_name';
                $table->string('provider_avatar')->nullable()->after($afterColumn);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kita juga buat rollback-nya "pintar"
            if (Schema::hasColumn('users', 'provider_name')) {
                $table->dropColumn('provider_name');
            }
            if (Schema::hasColumn('users', 'provider_id')) {
                $table->dropColumn('provider_id');
            }
            if (Schema::hasColumn('users', 'provider_avatar')) {
                $table->dropColumn('provider_avatar');
            }
        });
    }
};
