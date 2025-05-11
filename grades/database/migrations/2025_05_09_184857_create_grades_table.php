<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('teacher_id');
            $table->integer('grade');
            $table->timestamp('graded_date');
            $table->timestamp('updated_date')->nullable();
            $table->timestamps();
            
            $table->unique(['student_id', 'course_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
