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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained('category');
            $table->foreignId('brand_id')->constrained('brand');

            $table->integer('stock');
            $table->integer('stock_warning')->nullable();
            $table->string('SKU')->unique();
            $table->decimal('cprice', 8, 2)->nullable();
            $table->decimal('sprice', 8, 2);
            $table->decimal('weight', 8, 2);
            $table->string('weight_measurement');
            $table->string('status');
            $table->string('featured')->default(0);
            $table->longText('description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
