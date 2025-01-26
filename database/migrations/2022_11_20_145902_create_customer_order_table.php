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
        Schema::create('customer_order', function (Blueprint $table) {
            $table->id()->from(104153205);
            $table->unsignedInteger('customers_id');
            $table->foreign('customers_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('mode_of_payment');
            $table->string('payment_id')->nullable();
            $table->string('status');
            $table->string('received_by');
            $table->string('phone_number');
            $table->string('notes')->nullable();
            $table->string('house');
            $table->string('province');
            $table->string('city');
            $table->string('barangay');
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('cancellation_reason_id')->nullable();
            $table->foreign('cancellation_reason_id')->references('id')->on('cancellation_reason');
            $table->string('cancellation_details')->nullable();
            $table->string('rejected_reason')->nullable();
            $table->string('order_notes')->nullable();
            $table->string('details')->nullable();
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
        Schema::dropIfExists('customer_orders');
    }
};
