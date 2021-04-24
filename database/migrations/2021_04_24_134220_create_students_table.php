<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('episode_id', 20)->nullable(false)->unique();
            $table->string('student_name', 255)->nullable(false);
            $table->string('father_name')->nullable(true);
            $table->string('mother_name')->nullable(true);
            $table->string('guardian_name')->nullable(true);
            $table->string('relation_to_gurdian')->nullable(true);
            $table->date('dob')->nullable(true);
            $table->enum('sex', array('M', 'F', 'O'))->default('O');
            $table->string('address')->nullable(true);
            $table->string('city',50)->nullable(true);
            $table->string('distric',50)->nullable(true);

            $table->unsignedBigInteger('state_id');
            $table ->foreign('state_id')->references('id')->on('states')->onDelete('cascade');


            $table->string('state')->nullable(true);
            $table->string('pin',8)->nullable(true);
            $table->string('gurdian_contact_number',15)->nullable(true);
            $table->string('whatsapp_number',15)->nullable(true);
            $table->string('email_id',255)->nullable(true);
            $table->string('qualification',50)->nullable(true);
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
        Schema::dropIfExists('students');
    }
}
