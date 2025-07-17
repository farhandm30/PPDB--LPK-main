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
            // Add berkas fields to pendaftarans table (consistent with Berkas model)
            $table->string('ijazah_terakhir')->nullable()->after('foto_siswa');
            $table->string('ktp_sim_paspor')->nullable()->after('ijazah_terakhir');
            $table->string('bukti_pendaftaran')->nullable()->after('ktp_sim_paspor');
            $table->string('surat_pernyataan')->nullable()->after('bukti_pendaftaran');
            $table->string('berkas_lain_1')->nullable()->after('surat_pernyataan');
            $table->string('berkas_lain_2')->nullable()->after('berkas_lain_1');
            $table->string('berkas_lain_3')->nullable()->after('berkas_lain_2');
            $table->string('berkas_lain_4')->nullable()->after('berkas_lain_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn([
                'ijazah_terakhir',
                'ktp_sim_paspor',
                'bukti_pendaftaran',
                'surat_pernyataan',
                'berkas_lain_1',
                'berkas_lain_2',
                'berkas_lain_3',
                'berkas_lain_4'
            ]);
        });
    }
};
