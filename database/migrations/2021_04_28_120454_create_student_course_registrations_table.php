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
            $table ->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            //fees actual
            $table->integer('base_fee')->default(0);

            //discount allowed
            $table->integer('discount_allowed')->default(0);

            $table->date('joining_date')->nullable(false);
            $table->date('effective_date')->nullable(true);
            $table->date('completion_date')->nullable(true);

            $table->boolean('is_started')->default(false);
            $table->boolean('is_completed')->default(false);


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
