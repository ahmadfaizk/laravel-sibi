<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTNilaiMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_nilai_mapel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_siswa');
            $table->integer('nilai_pengetahuan');
            $table->integer('nilai_ketrampilan');

            $table->foreign('id_tahun_ajaran')->references('id')->on('m_tahun_ajaran');
            $table->foreign('id_kelas')->references('id')->on('m_kelas');
            $table->foreign('id_semester')->references('id')->on('m_semester');
            $table->foreign('id_mapel')->references('id')->on('m_mata_pelajaran');
            $table->foreign('id_siswa')->references('id')->on('m_siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_nilai_mapel');
    }
}
