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
            $table->foreignId('product_category_id')->references('id')->on('product_category');
            $table->string('stripe_product_id')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('discount')->nullable();
            $table->boolean('sale')->default(0);
            $table->boolean('status')->default(1);
            $table->integer('order_index')->default(0);
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
        Schema::dropIfExists('product');
    }
};
