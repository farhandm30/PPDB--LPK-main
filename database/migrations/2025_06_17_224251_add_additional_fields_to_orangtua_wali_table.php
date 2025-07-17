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
        Schema::table('orangtua_wali', function (Blueprint $table) {
            // Father's additional fields
            $table->string('nik_ayah')->nullable()->after('nama_ayah');
            $table->date('tgl_lahir_ayah')->nullable()->after('nik_ayah');
            $table->string('pendidikan_terakhir_ayah')->nullable()->after('tgl_lahir_ayah');

            // Mother's additional fields
            $table->string('nik_ibu')->nullable()->after('nama_ibu');
            $table->date('tgl_lahir_ibu')->nullable()->after('nik_ibu');
            $table->string('pendidikan_terakhir_ibu')->nullable()->after('tgl_lahir_ibu');

            // Guardian's additional fields
            $table->string('nik_wali')->nullable()->after('nama_wali');
            $table->date('tgl_lahir_wali')->nullable()->after('nik_wali');
            $table->string('pendidikan_terakhir_wali')->nullable()->after('tgl_lahir_wali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orangtua_wali', function (Blueprint $table) {
            // Father's fields
            $table->dropColumn('nik_ayah');
            $table->dropColumn('tgl_lahir_ayah');
            $table->dropColumn('pendidikan_terakhir_ayah');

            // Mother's fields
            $table->dropColumn('nik_ibu');
            $table->dropColumn('tgl_lahir_ibu');
            $table->dropColumn('pendidikan_terakhir_ibu');

            // Guardian's fields
            $table->dropColumn('nik_wali');
            $table->dropColumn('tgl_lahir_wali');
            $table->dropColumn('pendidikan_terakhir_wali');
        });
    }
};
