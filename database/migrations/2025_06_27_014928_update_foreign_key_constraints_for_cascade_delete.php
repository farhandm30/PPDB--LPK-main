<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update foreign key constraints to enable cascade deletion
     */
    public function up(): void
    {
        // We need to make sure that when a pendaftaran is deleted, it doesn't affect the user
        // But when a user is deleted, it should cascade to pendaftaran
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        // When a siswa is deleted, it should cascade to berkas and orangtua_wali
        Schema::table('berkas', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswas')
                ->onDelete('cascade');
        });

        Schema::table('orangtua_wali', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswas')
                ->onDelete('cascade');
        });

        // When a user is deleted, it should cascade to siswa
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the original foreign key constraints
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });

        Schema::table('berkas', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswas')
                ->onDelete('set null');
        });

        Schema::table('orangtua_wali', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->foreign('siswa_id')
                ->references('id')
                ->on('siswas')
                ->onDelete('set null');
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
        });
    }
};
