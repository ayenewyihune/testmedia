<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectShearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_shears', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('test_id')->unsigned();
            $table->bigInteger('testwork_id')->unsigned();

            $table->string('institute')->nullable();
            $table->string('test_date')->nullable();
            $table->string('tested_by')->nullable();
            $table->string('boring_number')->nullable();
            $table->string('sample_depth')->nullable();
            $table->string('visual_classification')->nullable();

            $table->string('diameter');
            $table->string('height')->nullable();
            $table->string('mass')->nullable();

            $table->string('nstress1');
            $table->string('nstress2');
            $table->string('nstress3');

            $table->string('records1');
            $table->string('records2');
            $table->string('records3');

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
        Schema::dropIfExists('direct_shears');
    }
}
