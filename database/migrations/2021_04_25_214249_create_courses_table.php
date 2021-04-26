<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code', 20)->nullable(false)->unique();
            $table->string('short_name', 50)->nullable(false);
            $table->string('full_name', 50)->nullable(false);
            $table->integer('course_duration')->default(0);
            $table->string('description', 50)->nullable(false);

            $table->enum('inforce', array(0, 1))->default(1);
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
        Schema::dropIfExists('courses');
    }
}
