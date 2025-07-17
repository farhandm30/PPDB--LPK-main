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
        Schema::table('berkas', function (Blueprint $table) {
            // Add new columns
            $table->string('rapot_semester_1')->nullable();
            $table->string('rapot_semester_2')->nullable();
            $table->string('rapot_semester_3')->nullable();
            $table->string('rapot_semester_4')->nullable();
            $table->string('ktp_orangtua')->nullable();

            // Drop unused columns
            $table->dropColumn(['ijazah', 'skhun', 'bukti_pembayaran']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas', function (Blueprint $table) {
            // Add back the original columns
            $table->string('ijazah')->nullable();
            $table->string('skhun')->nullable();
            $table->string('bukti_pembayaran')->nullable();

            // Drop the new columns
            $table->dropColumn([
                'rapot_semester_1',
                'rapot_semester_2',
                'rapot_semester_3',
                'rapot_semester_4',
                'ktp_orangtua'
            ]);
        });
    }
};
