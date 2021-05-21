<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id'); //must have a refernce 
            $table->string('cust_name',60); //customer first and last name in case of business compay name
            $table->unsignedInteger('order_id')->nullable(); //
            $table->unsignedInteger('quote_id')->nullable();
            $table->date('payment_date');
            $table->decimal('amount',10,2);
            $table->string('payment_method')->nullable(); //card,cheque,cash,bank.paypal
            $table->string('payment_ref')->nullable();  //card no,cheque no,bank ref etc
            $table->string('payment_type')->nullable();  //only two types payment or refund
            $table->string('detail')->nullable();  //any refund reason or advance etc
            $table->string('currency')->nullable();
            $table->decimal('exch_rate')->nullable();
            $table->unsignedInteger('updated_by');
            $table->timestamps();


            $table->foreign('customer_id')->references('id')->on('customers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
