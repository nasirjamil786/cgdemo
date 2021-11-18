<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orlines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('line_no');
            $table->string('item_no')->nullable();
            $table->string('item_detail')->nullable();
            $table->string('item_notes')->nullable();
            $table->string('line_status')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->decimal('cost',10,2)->nullable();
            $table->decimal('value',10,2)->nullable();
            $table->string('supp_ref')->nullable();
            $table->decimal('commission',10,2)->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->index(['order_id','line_no']);

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orlines');
    }
}
