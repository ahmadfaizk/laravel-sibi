<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTKetidakhadiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_ketidakhadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_semester');
            $table->unsignedBigInteger('id_siswa');
            $table->integer('sakit');
            $table->integer('izin');
            $table->integer('tanpa_keterangan');
            $table->foreign('id_tahun_ajaran')->references('id')->on('m_tahun_ajaran');
            $table->foreign('id_kelas')->references('id')->on('m_kelas');
            $table->foreign('id_semester')->references('id')->on('m_semester');
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
        Schema::dropIfExists('t_ketidakhadiran');
    }
}
