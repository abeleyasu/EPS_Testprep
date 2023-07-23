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
        Schema::create('product_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->references('id')->on('product');
            $table->string('stripe_plan_id')->nullable();
            $table->string('interval_count')->nullable();
            $table->string('interval')->nullable();
            $table->string('currency')->default('USD');
            $table->string('amount')->nullable();
            $table->string('display_amount')->nullable();
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
        Schema::dropIfExists('product_plan');
    }
};
