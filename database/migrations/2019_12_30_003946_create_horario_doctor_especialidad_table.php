<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioDoctorEspecialidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_doctor_especialidad', function (Blueprint $table) {
            $table->increments('id');
            $table->string('horario');
            $table->unsignedInteger('doctor_especialidad_id');

            $table->foreign('doctor_especialidad_id')->references('id')->on('doctor_especialidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_doctor_especialidad');
    }
}
