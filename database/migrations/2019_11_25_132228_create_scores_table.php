<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('score_column_id');
            $table->unsignedBigInteger('student_id');
            $table->float('score')->nullable();

            $table->foreign('score_column_id')->references('id')->on('score_columns');
            $table->foreign('student_id')->references('id')->on('students');

            $table->unique(['student_id', 'score_column_id']);
        });
        /*Schema::table('score_columns', function (Blueprint $table) {
            $table->foreign('score_id')->references('id')->on('scores');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
