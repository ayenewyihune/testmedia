<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoreholeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borehole_logs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('test_id')->unsigned();
            $table->bigInteger('testwork_id')->unsigned();

            $table->string('project')->nullable();
            $table->string('client')->nullable();
            $table->string('location')->nullable();
            $table->string('coordinatex')->nullable();
            $table->string('coordinatey')->nullable();
            $table->string('elevation')->nullable();
            $table->string('drill_method')->nullable();
            $table->string('borehole_id')->nullable();
            $table->string('inclination')->nullable();
            $table->string('depth')->nullable();
            $table->string('bit_type')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('water_level')->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('test_id')->references('id')->on('tests');
            $table->foreign('testwork_id')->references('id')->on('testworks');

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
        Schema::dropIfExists('borehole_logs');
    }
}
