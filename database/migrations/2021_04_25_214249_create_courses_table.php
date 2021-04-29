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
            $table->bigInteger('fees_mode_type_id')->unsigned();
            $table ->foreign('fees_mode_type_id')->references('id')->on('fees_mode_types')->onDelete('cascade');

            $table->string('course_code', 20)->nullable(false)->unique();
            $table->string('short_name', 50)->nullable(false);
            $table->string('full_name', 50)->nullable(false);
            $table->integer('course_duration')->default(0);

<<<<<<< HEAD
            // $table->bigInteger('duration_type_id');
            // $table->foreign('duration_type_id')->references('id')->on('duration_types')->onDelete('cascade');


=======
>>>>>>> 57c3617e54357cf271f3bfc01b9b21fa3ddc59ad
            $table->string('description', 50)->nullable(true);

            $table->bigInteger('duration_type_id')->unsigned();
            $table ->foreign('duration_type_id')->references('id')->on('duration_types')->onDelete('cascade');


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
