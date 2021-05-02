<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_masters', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number',20)->unique()->nullable(false);
            //StudentCourseRegistration reference
            $table->foreignId('student_course_registration_id')->nullable(true)->references('id')->on('student_course_registrations')->onDelete('cascade');

            //transaction_master_reference
            $table->foreignId('reference_transaction_master_id')->nullable(true)->references('id')->on('transaction_masters')->onDelete('cascade');

            $table->foreignId('user_id')->nullable(false)->references('id')->on('ledgers')->onDelete('cascade');

            $table->foreignId('voucher_type_id')->nullable(false)->references('id')->on('voucher_types')->onDelete('cascade');

            $table->date('transaction_date')->nullable(false);
            $table->string('comment',255)->nullable(true);

            $table->tinyInteger('inforce')->default('1');
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
        Schema::dropIfExists('transaction_masters');
    }
}
