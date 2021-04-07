<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nomor_nis');
            $table->string('nomor_nisn');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama');
            $table->string('alamat_peserta_didik');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->string('pendidikan_sebelumnya');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('pekerjaan_wali')->nullable();
            $table->string('foto_masuk')->nullable();
            $table->string('foto_keluar')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('alamat_orangtua')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->enum('status', ['aktif', 'alumni', 'keluar'])->default('aktif');
            $table->integer('masuk_tingkat');
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->unsignedBigInteger('id_ta_masuk');
            $table->timestamps();

            $table->foreign('id_kelas')->references('id')->on('m_kelas');
            $table->foreign('id_ta_masuk')->references('id')->on('m_tahun_ajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_siswa');
    }
}
