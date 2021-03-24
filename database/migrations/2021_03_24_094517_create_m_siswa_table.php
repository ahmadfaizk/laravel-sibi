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
            $table->date('tanggal_lahir');
            $table->string('pendidikan_sebelumnya');
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('foto_masuk')->nullable();
            $table->string('foto_keluar')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('alamat_jalan')->nullable();
            $table->string('alamat_kelurahan')->nullable();
            $table->string('alamat_kecamatan')->nullable();
            $table->string('alamat_kabupaten')->nullable();
            $table->string('alamat_provinsi')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_ta_masuk');
            $table->unsignedBigInteger('id_ta_keluar')->nullable();

            $table->foreign('id_kelas')->references('id')->on('m_kelas');
            $table->foreign('id_ta_masuk')->references('id')->on('m_tahun_ajaran');
            $table->foreign('id_ta_keluar')->references('id')->on('m_tahun_ajaran');
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
