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
            if (Schema::hasColumn('pendaftarans', 'jenis_daftar')) {
                $table->dropColumn('jenis_daftar');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftarans', 'jenis_daftar')) {
                $table->string('jenis_daftar')->default('Reguler')->after('no_daftar');
            }
        });
    }
};
