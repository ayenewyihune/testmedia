<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('test_id')->unsigned();
            $table->bigInteger('testwork_id')->unsigned();

            $table->string('institute')->nullable();
            $table->string('test_date')->nullable();
            $table->string('tested_by')->nullable();
            $table->string('boring_number')->nullable();

            $table->string('efficiency');
            $table->string('correction_bd');
            $table->string('correction_s');
            $table->string('correction_rl');

            $table->string('records');

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
        Schema::dropIfExists('spts');
    }
}
