<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseClassUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::create('course_class_user', function (Blueprint $table) {
        //    $table->unsignedBigInteger('user_id');
        //    $table->unsignedBigInteger('course_class_id');

        //    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //    $table->foreign('course_class_id')->references('id')->on('course_classes')->onDelete('cascade');

        //    $table->unique(['user_id', 'course_class_id']);
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_class_user');
    }
}
