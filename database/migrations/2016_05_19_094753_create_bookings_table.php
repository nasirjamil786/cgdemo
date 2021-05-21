<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');

            $table->dateTime('booking_date')->nullable();
            $table->Time('booking_time')->nullable();
            $table->string('location')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('town')->nullable();
            $table->string('postcode')->nullable();
            $table->string('email')->nullable();
            $table->string('status')->nullable();
            $table->string('notes')->nullable();
            $table->string('event_id')->nullable();
            $table->unsignedInteger('assigned_to');
            $table->unsignedInteger('booked_by');
            $table->string('updated_by')->nullable();

            $table->foreign('assigned_to')->references('id')->on('users');
            $table->foreign('booked_by')->references('id')->on('users');
            
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
        Schema::drop('bookings');
    }
}
