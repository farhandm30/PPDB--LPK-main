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
            // Remove schedule fields as they will be managed through WhatsApp updates
            $table->dropColumn([
                'jadwal_daftar_ulang',
                'tgl_wawancara',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            // Add back the schedule fields if needed to rollback
            $table->date('jadwal_daftar_ulang')->nullable();
            $table->date('tgl_wawancara')->nullable();
        });
    }
};
