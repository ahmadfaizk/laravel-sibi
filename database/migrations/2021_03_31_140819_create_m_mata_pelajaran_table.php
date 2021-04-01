<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMMataPelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kategori_mapel');
            $table->string('nama');
            $table->timestamps();

            $table->foreign('id_kategori_mapel')->references('id')->on('m_kategori_mapel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_mata_pelajaran');
    }
}
