<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('tingkat');
            $table->unsignedBigInteger('id_tahun_ajaran');
            $table->timestamps();

            $table->foreign('id_tahun_ajaran')->references('id')->on('m_tahun_ajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_kelas');
    }
}
