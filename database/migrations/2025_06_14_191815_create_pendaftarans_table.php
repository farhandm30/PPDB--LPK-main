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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('no_daftar', 30)->unique();
            $table->string('jenis_daftar', 50)->nullable();
            $table->date('tgl_daftar')->nullable();
            $table->foreignId('id_jurusan')->constrained('jurusans');
            $table->foreignId('id_tahun_ajaran')->constrained('tahun_ajarans');
            $table->string('asal_sekolah', 100);
            $table->text('referensi');
            $table->string('nama_siswa', 100);
            $table->string('nik_siswa', 30);
            $table->string('jk_siswa', 20);
            $table->string('tempat_lahir_siswa', 50);
            $table->date('tgl_lahir_siswa');
            $table->string('agama_siswa', 20);
            $table->string('alamat_siswa', 100);
            $table->string('email_siswa', 50);
            $table->string('nohp_siswa', 30);
            $table->string('foto_siswa', 150);
            $table->string('nik_ayah', 30);
            $table->string('nama_ayah', 100);
            $table->date('tgl_lahir_ayah')->nullable();
            $table->string('pendidikan_terakhir_ayah', 30);
            $table->string('pekerjaan_ayah', 30);
            $table->integer('penghasilan_ayah');
            $table->string('nik_ibu', 30);
            $table->string('nama_ibu', 100);
            $table->date('tgl_lahir_ibu')->nullable();
            $table->string('pendidikan_terakhir_ibu', 30);
            $table->string('pekerjaan_ibu', 30);
            $table->integer('penghasilan_ibu');
            $table->string('nik_wali', 30);
            $table->string('nama_wali', 100);
            $table->date('tgl_lahir_wali')->nullable();
            $table->string('pendidikan_terakhir_wali', 30);
            $table->string('pekerjaan_wali', 30);
            $table->integer('penghasilan_wali');
            $table->string('berkas_1', 150);
            $table->string('berkas_2', 150);
            $table->string('berkas_3', 150);
            $table->string('berkas_4', 150);
            $table->string('berkas_5', 150);
            $table->string('berkas_6', 150);
            $table->string('status_dokumen', 20);
            $table->string('status_daftar', 20);
            $table->date('tgl_wawancara')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
