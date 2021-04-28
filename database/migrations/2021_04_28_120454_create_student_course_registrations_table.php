<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStudentCourseRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_course_registrations', function (Blueprint $table) {
            $table->id();

            //adding student reference
            $table->bigInteger('ledger_id')->unsigned();
            $table ->foreign('ledger_id')->references('id')->on('ledgers')->onDelete('cascade');

            //adding course
            $table->bigInteger('course_id')->unsigned();
            $table ->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');;

            $table->date('joining_date')->nullable(true);
            $table->date('effective_date')->nullable(true);
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
        Schema::dropIfExists('student_course_registrations');
    }
}
