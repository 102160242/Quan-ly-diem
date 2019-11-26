<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('academic_rank_id')->nullable();
            $table->unsignedInteger('degree_id')->nullable();
            $table->unsignedInteger('specialization_id')->nullable();
            $table->unsignedInteger('faculty_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('academic_rank_id')->references('id')->on('academic_ranks')->onDelete('set null');
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('set null');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('set null');
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
