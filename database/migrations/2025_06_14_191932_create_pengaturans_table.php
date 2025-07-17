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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi', 50);
            $table->string('nama_instansi', 100);
            $table->text('alamat_instansi');
            $table->string('notlp_instansi', 20);
            $table->string('email_instansi', 50);
            $table->text('logo_persegi');
            $table->string('fb_instansi', 50);
            $table->string('x_instansi', 50);
            $table->string('instagram_instansi', 50);
            $table->string('youtube_instansi', 50);
            $table->string('tiktok_instansi', 50);
            $table->text('tentang_kami');
            $table->text('sejarah');
            $table->text('visi');
            $table->text('misi');
            $table->text('meta_keyword')->nullable();
            $table->text('meta_deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturans');
    }
};
