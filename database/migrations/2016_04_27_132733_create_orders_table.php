<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('device_id');

            $table->unsignedInteger('make_id');

            $table->unsignedInteger('order_ref');
            $table->unsignedInteger('quote_id')->nullable();

            $table->dateTime('booking_date'); //Actual work date 
            $table->time('booking_time');
            $table->dateTime('complete_date')->nullable();  //invoice date 
            $table->dateTime('collection_date')->nullable();
            $table->time('collection_time')->nullable();
            $table->dateTime('followup_date')->nullable();
            $table->time('followup_time')->nullable();

            $table->text('location');
            $table->string('order_status');
            
            $table->string('model')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('condition')->nullable();
            $table->string('colour')->nullable();
            $table->string('data_backup')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->text('device_notes')->nullable();
            $table->decimal('estimate_parts',10,2)->nullable();
            $table->decimal('estimate_services',10,2)->nullable();
            $table->Text('order_notes')->nullable();
            $table->Text('private_notes')->nullable();
            $table->text('work_detail')->nulable();
            $table->Text('recommendations')->nullable();
            $table->decimal('line_total',10,2)->nullable();
            $table->integer('discount_percent')->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('delivery_charges',10,2)->nullable();
            $table->decimal('total_beforevat',10,2)->nullable();
            $table->decimal('vat_rate',10,2)->nullable();
            $table->decimal('vat',10,2)->nullable();
            $table->decimal('order_total',10,2)->nullable();
            $table->date('payment_date')->nullable();
            $table->decimal('payment',10,2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_ref')->nullable();
            $table->string('signature')->nullable();
            $table->boolean('send_email');
            $table->string('event_id')->nullable();
            $table->unsignedInteger('worked_by');
            $table->unsignedInteger('taken_by');
            $table->unsignedInteger('updated_by');

            $table->timestamps();
            $table->index('order_ref');
            
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('worked_by')->references('id')->on('users');
            $table->foreign('taken_by')->references('id')->on('users');
            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('make_id')->references('id')->on('makes');


            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
