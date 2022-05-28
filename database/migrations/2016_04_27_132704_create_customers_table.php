<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('cust_title',4);
            $table->string('first_name',30);
            $table->string('last_name',30);
            $table->string('company')->nullable();
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('town');
            $table->string('postcode',10);
            $table->string('county')->nullable();
            $table->string('country');
            $table->string('email')->unique();
            $table->string('ccemail')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('recommended_by')->nullable();
            $table->string('recommended_name')->nullable();
            $table->string('cust_type')->nullable();
            $table->decimal('outstand_balance',10,2)->nullable();
            $table->decimal('account_total',10,2)->nullable();
            $table->integer('discount')->nullable();
            $table->string('status');
            $table->string('newsletter')->nullable();
            $table->string('voter')->nullable();
            $table->string('voters')->nullable();
            $table->text('notes')->nullable();
            $table->string('old_ref')->nullable();
            $table->string('subscription_status')->nullable();
            $table->string('updated_by');
            $table->boolean('send_email');

            $table->softDeletes();
            $table->timestamps();
            
            $table->index(['first_name', 'last_name'],'nameind');
            $table->index('postcode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
    }
}
