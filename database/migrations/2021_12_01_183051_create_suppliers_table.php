<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('address1');
            $table->string('address2');
            $table->string('address3');
            $table->string('town');
            $table->string('county');
            $table->string('postcode');
            $table->string('country');
            $table->string('contact1');
            $table->string('email1');
            $table->string('phone1');
            $table->string('mobile1');
            $table->string('contact2');
            $table->string('email2');
            $table->string('phone2');
            $table->string('mobile2');
            $table->string('website');
            $table->string('username');
            $table->string('password');
            $table->string('account');
            $table->string('notes');
            $table->string('currency');
            $table->string('vatno');

            $table->string('updated_by');
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
        Schema::dropIfExists('suppliers');
    }
}
