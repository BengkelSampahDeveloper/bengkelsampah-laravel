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
        Schema::table('bank_sampah', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('kontak_penanggung_jawab');
            $table->enum('tipe_layanan', ['jemput', 'tempat', 'keduanya'])->default('keduanya')->after('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bank_sampah', function (Blueprint $table) {
            $table->dropColumn(['foto', 'tipe_layanan']);
        });
    }
};
