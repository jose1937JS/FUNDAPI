<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnterpriseEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enterprise_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->unsignedInteger('enterprise_id');

            $table->foreign('enterprise_id')->references('id')->on('enterprises');
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
        Schema::dropIfExists('enterprise_emails');
    }
}
