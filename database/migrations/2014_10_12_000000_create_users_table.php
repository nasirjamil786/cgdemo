<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name');
            $table->string('position');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('area')->nullable();
            $table->string('town');
            $table->string('county')->nullable();
            $table->string('postcode');
            $table->string('country');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('tax_no')->nullable();
            $table->string('user_status');
            $table->text('notes')->nullable();
            $table->decimal('commission',10,2)->nullable();
            $table->string('ipaddress')->nullable();
            $table->string('login_device')->nulable();
            $table->string('email')->unique();
            $table->string('personal_email')->nullable();
            $table->string('cc')->nullable();
            $table->string('bcc')->nullable();
            $table->string('password');
            $table->string('password_hint')->nullable();
            $table->string('updated_by');
            $table->tinyInteger('can_settings'); // 0 = not 1 = yes 
            $table->tinyInteger('can_reports');     // 0 = not 1 = yes 

            $table->tinyInteger('can_closeOrder');     // 0 = not 1 = yes 
            $table->tinyInteger('can_delPay');     // 0 = not 1 = yes 

            $table->rememberToken();
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
        Schema::drop('users');
    }
}
