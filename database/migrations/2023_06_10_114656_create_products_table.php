<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supp_id');
            $table->string('brand');
            $table->string('description');
            $table->string('detail');
            $table->string('label1');
            $table->string('label2');
            $table->string('label3');
            $table->string('label4');
            $table->string('label5');
            $table->string('label6');
            $table->string('label7');
            $table->string('label8');
            $table->string('label9');
            $table->string('label10');
            $table->string('spec1');
            $table->string('spec2');
            $table->string('spec3');
            $table->string('spec4');
            $table->string('spec5');
            $table->string('spec6');
            $table->string('spec7');
            $table->string('spec8');
            $table->string('spec9');
            $table->string('spec10');
            $table->decimal('price');
            $table->integer('quantity');
            $table->binary('image');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
