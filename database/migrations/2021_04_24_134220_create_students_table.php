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
        try{
            Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('episode_id',20)->nullable(false)->unique();
            $table->string('student_name',255)->nullable(false);
            $table->string('father_name')->nullable(true);
            $table->string('mother_name')->nullable(true);
            $table->string('guardian_name')->nullable(true);
            $table->string('relation_to_gurdian')->nullable(true);
            $table->date('dob')->nullable(true);
            // $table->string('sex', 1)->nulable(false);
            $table->enum('sex', array('M','F','O'))->default('O')->change();
            $table->string('address')->nullable(true);
            $table->string('city')->nullable(true);
            $table->string('distric')->nullable(true);
            $table->string('state')->nullable(true);
            $table->string('pin')->nullable(true);
            $table->string('gurdian_contact_number')->nullable(true);
            $table->string('whatsapp_number')->nullable(true);
            $table->string('email_id')->nullable(true);
            $table->string('qualification')->nullable(true);
            $table->tinyInteger('inforce')->default(1);
            $table->timestamps();
         
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
