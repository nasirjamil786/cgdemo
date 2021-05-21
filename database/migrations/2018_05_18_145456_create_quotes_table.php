<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('quotes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('order_id')->nullable();

            $table->dateTime('quote_date');
            $table->dateTime('valid_date');
            $table->dateTime('email_sent')->nullable();
            $table->string('quote_status')->nullable();
            $table->string('notes')->nullable();
            $table->string('quote_title')->nullable();
            $table->text('work_detail')->nullable();
            $table->decimal('line_total',10,2)->nullable();
            $table->integer('discount_percent')->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('delivery_charges',10,2)->nullable();
            $table->decimal('total_beforevat',10,2)->nullable();
            $table->decimal('vat_rate',10,2)->nullable();
            $table->decimal('vat',10,2)->nullable();
            $table->decimal('quote_total',10,2)->nullable();

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
        Schema::drop('quotes');
    }
}
