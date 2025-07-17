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
            // Check if columns exist before dropping
            if (Schema::hasColumn('berkas', 'kartu_keluarga')) {
                $table->dropColumn('kartu_keluarga');
            }

            if (Schema::hasColumn('berkas', 'akta_kelahiran')) {
                $table->dropColumn('akta_kelahiran');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berkas', function (Blueprint $table) {
            // Add back columns if they don't exist
            if (!Schema::hasColumn('berkas', 'kartu_keluarga')) {
                $table->string('kartu_keluarga')->nullable();
            }

            if (!Schema::hasColumn('berkas', 'akta_kelahiran')) {
                $table->string('akta_kelahiran')->nullable();

            }
        });
    }
};