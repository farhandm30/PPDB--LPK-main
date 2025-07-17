<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            // Drop old status columns
            $table->dropColumn('status_dokumen');
            $table->dropColumn('status_daftar');

            // Add new status columns
            $table->string('status_data_diri')->default('Belum Lengkap');
            $table->string('status_data_orangtua')->default('Belum Lengkap');
            $table->string('status_berkas')->default('Belum Lengkap');
            $table->string('status_pendaftaran')->default('Menunggu Verifikasi');
            $table->date('jadwal_daftar_ulang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            // Drop new status columns
            $table->dropColumn('status_data_diri');
            $table->dropColumn('status_data_orangtua');
            $table->dropColumn('status_berkas');
            $table->dropColumn('status_pendaftaran');
            $table->dropColumn('jadwal_daftar_ulang');

            // Add back old status columns
            $table->string('status_dokumen')->default('Belum Lengkap');
            $table->string('status_daftar')->default('Menunggu Verifikasi');
        });
    }
};
