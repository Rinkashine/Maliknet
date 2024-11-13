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
        Schema::create('product_review', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->onDelete('cascade');
            $table->foreignId('customer_order_item_id')->constrained('customer_order_item')->onDelete('cascade');
            $table->foreignId('customer_order_id')->constrained('customer_order')->onDelete('cascade');
            $table->longText('comment');
            $table->integer('rate');
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
        Schema::dropIfExists('product_review');
    }
};
