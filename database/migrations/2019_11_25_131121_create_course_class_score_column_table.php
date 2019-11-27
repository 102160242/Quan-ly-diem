<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseClassScoreColumnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_class_score_column', function (Blueprint $table) {
            $table->unsignedBigInteger('score_column_id');
            $table->unsignedBigInteger('course_class_id');

            $table->foreign('score_column_id')->references('id')->on('score_columns');
            $table->foreign('course_class_id')->references('id')->on('course_classes');

            $table->unique(['score_column_id', 'course_class_id'], 'sc_id_cc_id_is_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_classes_score_columns');
    }
}
