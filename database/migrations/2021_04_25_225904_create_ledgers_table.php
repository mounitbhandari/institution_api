<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('ledger_name')->unique()->nullable(false);
            $table->string('billing_name')->nullable(false);

            $table->bigInteger('ledger_group_id')->unsigned();
            $table ->foreign('ledger_group_id')->references('id')->on('ledger_groups')->onDelete('cascade');;


            //for Bank only
            $table->String('branch', 100)->nullable(true);
            $table->String('account_number', 30)->nullable(true);
            $table->String('ifsc', 20)->nullable(true);


            $table->bigInteger('transaction_type_id')->unsigned();
            $table ->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->decimal('opening_balance')->default(0);

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
        Schema::dropIfExists('ledgers');
    }
}
