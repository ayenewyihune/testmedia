<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('designation')->nullable();
            $table->string('name');
            $table->text('scope')->nullable();
            $table->string('reference')->nullable();
            $table->text('terminology')->nullable();
            $table->text('use')->nullable();
            $table->text('preparation')->nullable();
            $table->text('procedure');
            $table->text('calculation')->nullable();
            $table->text('report')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('tests');
    }
}
