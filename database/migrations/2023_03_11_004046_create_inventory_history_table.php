<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('product')->onDelete('cascade');
            $table->string('activity');
            $table->string('adjusted_by')->nullable();
            $table->string('operation_value');
            $table->string('latest_value');
            $table->unsignedBigInteger('purchase_order_id')->nullable();

            $table->foreign('purchase_order_id')->references('id')->on('purchase_order');

            $table->unsignedBigInteger('customer_order_id')->nullable();
            $table->foreign('customer_order_id')->references('id')->on('customer_order');
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
        Schema::dropIfExists('inventory_history');
    }
};
