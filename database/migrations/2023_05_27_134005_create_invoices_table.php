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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('supp_id');

            $table->string('invno')->nullable();
            $table->date('inv_date')->nullable();
            $table->string('vatno')->nullable();
            $table->string('suppname')->nullable();
            $table->string('filename')->nullable();
            $table->decimal('linetotal',10,2)->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('delivery',10,2)->nullable();
            $table->decimal('subtotal',10,2)->nullable(); // total before vat
            $table->decimal('vatrate',10,2)->nullable();
            $table->decimal('vat',10,2)->nullable();
            $table->decimal('total',10,2);

            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('supp_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
