<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_kelas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_siswa');

            $table->foreign('id_kelas')->references('id')->on('m_kelas');
            $table->foreign('id_siswa')->references('id')->on('m_siswa');

            $table->primary(['id_kelas', 'id_siswa']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_kelas');
    }
}
