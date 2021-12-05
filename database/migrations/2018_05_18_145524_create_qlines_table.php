<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('qlines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quote_id');
            $table->unsignedInteger('line_no');
            $table->string('item_no')->nullable();
            $table->string('item_detail')->nullable();
            $table->string('item_image')->nullable();
            $table->string('spec1')->nullable();
            $table->string('spec2')->nullable();
            $table->string('spec3')->nullable();
            $table->string('spec4')->nullable();
            $table->string('spec5')->nullable();
            $table->string('spec6')->nullable();
            $table->string('spec7')->nullable();
            $table->string('spec8')->nullable();
            $table->string('spec9')->nullable();
            $table->string('spec10')->nullable();
            $table->string('spec11')->nullable();
            $table->string('spec12')->nullable();
            $table->string('spec13')->nullable();
            $table->string('spec14')->nullable();
            $table->string('spec15')->nullable();
            $table->string('item_notes')->nullable();
            $table->string('item_type')->nullable(); // parts or services will assign to orlines->item_notes
            $table->string('line_status')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('cost',10,2)->nullable();
            $table->decimal('commission',10,2)->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->decimal('value',10,2)->nullable();
            $table->decimal('vat_rate',10,2)->nullable();
            $table->decimal('vat',10,2)->nullable();
            $table->integer('supp_id')->nullable();
            $table->string('supp_name')->nullable();
            $table->string('supp_ref')->nullable();

            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->index(['quote_id','line_no']);

            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('qlines');
    }
}
