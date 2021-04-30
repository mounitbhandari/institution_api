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

            $table->foreignId('fees_mode_type_id')->nullable(false)->references('id')->on('fees_mode_types')->onDelete('cascade');
            $table->string('course_code', 20)->nullable(false)->unique();
            $table->string('short_name', 50)->nullable(false);
            $table->string('full_name', 50)->nullable(false);
            $table->integer('course_duration')->default(0);
            $table->string('description', 50)->nullable(true);
            $table->foreignId('duration_type_id')->nullable(false)->references('id')->on('duration_types')->onDelete('cascade');
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
