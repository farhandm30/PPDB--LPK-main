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
        Schema::table('siswas', function (Blueprint $table) {
            // Add missing nik field
            $table->string('nik', 16)->nullable()->after('no_pendaftaran');

            // Rename tgl_lahir to tanggal_lahir if it doesn't exist
            if (Schema::hasColumn('siswas', 'tgl_lahir') && !Schema::hasColumn('siswas', 'tanggal_lahir')) {
                $table->renameColumn('tgl_lahir', 'tanggal_lahir');
            }

            // If tanggal_lahir doesn't exist and tgl_lahir doesn't exist, add tanggal_lahir
            if (!Schema::hasColumn('siswas', 'tanggal_lahir') && !Schema::hasColumn('siswas', 'tgl_lahir')) {
                $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn('nik');

            if (Schema::hasColumn('siswas', 'tanggal_lahir')) {
                $table->renameColumn('tanggal_lahir', 'tgl_lahir');
            }
        });
    }
};
