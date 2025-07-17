<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('berkas', function (Blueprint $table) {
            // Check and drop old columns if they exist
            $columns = ['rapot_semester_1', 'rapot_semester_2', 'rapot_semester_3', 'rapot_semester_4', 'skhun', 'ktp_orangtua'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('berkas', $column)) {
                    $table->dropColumn($column);
                }
            }

            // Add new columns if they don't exist
            if (!Schema::hasColumn('berkas', 'ijazah_terakhir')) {
                $table->string('ijazah_terakhir')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'ktp_sim_paspor')) {
                $table->string('ktp_sim_paspor')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'bukti_pendaftaran')) {
                $table->string('bukti_pendaftaran')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'surat_pernyataan')) {
                $table->string('surat_pernyataan')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'berkas_lain_1')) {
                $table->string('berkas_lain_1')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'berkas_lain_2')) {
                $table->string('berkas_lain_2')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'berkas_lain_3')) {
                $table->string('berkas_lain_3')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'berkas_lain_4')) {
                $table->string('berkas_lain_4')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas', function (Blueprint $table) {
            // Drop new columns
            $newColumns = [
                'ijazah_terakhir',
                'ktp_sim_paspor',
                'bukti_pendaftaran',
                'surat_pernyataan',
                'berkas_lain_1',
                'berkas_lain_2',
                'berkas_lain_3',
                'berkas_lain_4'
            ];

            foreach ($newColumns as $column) {
                if (Schema::hasColumn('berkas', $column)) {
                    $table->dropColumn($column);
                }
            }

            // Add back old columns
            if (!Schema::hasColumn('berkas', 'rapot_semester_1')) {
                $table->string('rapot_semester_1')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'rapot_semester_2')) {
                $table->string('rapot_semester_2')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'rapot_semester_3')) {
                $table->string('rapot_semester_3')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'rapot_semester_4')) {
                $table->string('rapot_semester_4')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'skhun')) {
                $table->string('skhun')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'ktp_orangtua')) {
                $table->string('ktp_orangtua')->nullable();
            }
        });
    }
};