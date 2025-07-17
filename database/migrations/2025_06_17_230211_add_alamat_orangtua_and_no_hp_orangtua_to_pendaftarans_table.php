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
            // Add the alamat_orangtua field after pekerjaan_wali
            $table->text('alamat_orangtua')->nullable()->after('penghasilan_wali');

            // Add the no_hp_orangtua field after alamat_orangtua
            $table->string('no_hp_orangtua')->nullable()->after('alamat_orangtua');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn('alamat_orangtua');
            $table->dropColumn('no_hp_orangtua');
        });
    }
};
