<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasMapelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas_mapel', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_mapel');

            $table->foreign('id_kelas')->references('id')->on('m_kelas');
            $table->foreign('id_mapel')->references('id')->on('m_mata_pelajaran');

            $table->primary(['id_kelas', 'id_mapel']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas_mapel');
    }
}
