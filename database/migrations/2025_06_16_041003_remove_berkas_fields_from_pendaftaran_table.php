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
            // Remove the berkas fields as they're now handled by the Berkas model
            $table->dropColumn([
                'berkas_1',
                'berkas_2',
                'berkas_3',
                'berkas_4',
                'berkas_5',
                'berkas_6',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            // Add back the berkas fields if needed to rollback
            $table->string('berkas_1')->nullable();
            $table->string('berkas_2')->nullable();
            $table->string('berkas_3')->nullable();
            $table->string('berkas_4')->nullable();
            $table->string('berkas_5')->nullable();
            $table->string('berkas_6')->nullable();
        });
    }
};
