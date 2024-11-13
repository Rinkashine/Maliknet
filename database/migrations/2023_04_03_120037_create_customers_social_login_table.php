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
        Schema::create('customers_social_login', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customers_id');
            $table->foreign('customers_id')->references('id')->on('customers')->onDelete('cascade');
            $table->string('provider_name');
            $table->string('provider_id');
            $table->unique(['provider_name', 'provider_id']);
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
        Schema::dropIfExists('customers_social_login');
    }
};
