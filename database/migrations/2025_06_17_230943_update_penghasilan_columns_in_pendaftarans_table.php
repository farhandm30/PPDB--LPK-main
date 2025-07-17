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
            // Modify the penghasilan columns to be string type with sufficient length
            $table->string('penghasilan_ayah', 100)->change();
            $table->string('penghasilan_ibu', 100)->change();
            $table->string('penghasilan_wali', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            // Revert back to original types if needed
            $table->string('penghasilan_ayah')->change();
            $table->string('penghasilan_ibu')->change();
            $table->string('penghasilan_wali')->nullable()->change();
        });
    }
};
