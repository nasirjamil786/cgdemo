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
            $table->string('test_startup')->nullable();
            $table->text('test_startup_comm')->nullable();
            $table->string('test_sound')->nullable();
            $table->text('test_sound_comm')->nullable();
            $table->string('test_camera')->nullable();
            $table->text('test_camera_comm')->nullable();
            $table->string('test_wifi')->nullable();
            $table->text('test_wifi_comm')->nullable();
            $table->string('test_ethernet')->nullable();
            $table->text('test_ethernet_comm')->nullable();
            $table->string('test_keyboard')->nullable();
            $table->text('test_keyboard_comm')->nullable();
            $table->string('test_trackpad')->nullable();
            $table->text('test_trackpad_comm')->nullable();
            $table->string('test_headphone')->nullable();
            $table->text('test_headphone_comm')->nullable();
            $table->string('test_display')->nullable();
            $table->text('test_display_comm')->nullable();
            $table->string('test_homebutton')->nullable();
            $table->text('test_homebutton_comm')->nullable();
            $table->string('test_microphone')->nullable();
            $table->text('test_microphone_comm')->nullable();
            $table->string('test_fan')->nullable();
            $table->text('test_fan_comm')->nullable();
            $table->string('test_battery')->nullable();
            $table->text('test_battery_comm')->nullable();
            $table->string('test_chport')->nullable();
            $table->text('test_chport_comm')->nullable();
            $table->string('test_shutdown')->nullable();
            $table->text('test_shutdown_comm')->nullable();
            $table->string('test_earphone')->nullable();
            $table->text('test_earphone_comm')->nullable();
            $table->string('test_others')->nullable();
            $table->text('test_others_comm')->nullable();
            $table->date('test_date')->nullable();
            $table->string('tested_by')->nullable();
            $table->date('test_emailed')->nullable();
            $table->dateTime('fixednotif_emailed')->nullable();
            $table->dateTime('inv_emailed')->nullable();
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
