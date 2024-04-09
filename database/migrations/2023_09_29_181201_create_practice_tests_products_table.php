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
        Schema::create('practice_test_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practice_test_id')->references('id')->on('practice_tests')->cascadeOnDelete();
            $table->foreignId('product_id')->references('id')->on('product')->cascadeOnDelete();
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
        Schema::dropIfExists('practice_test_product');
    }
};
