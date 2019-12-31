<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleDoctorSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_doctor_specialties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('schedule');
            $table->unsignedInteger('doctor_specialties_id');

            $table->foreign('doctor_specialties_id')->references('id')->on('doctor_specialties');
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
        Schema::dropIfExists('schedule_doctor_specialties');
    }
}
