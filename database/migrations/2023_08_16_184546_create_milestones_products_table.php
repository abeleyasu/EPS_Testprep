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
        Schema::create('milestones_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('milestone_id')->references('id')->on('milestones')->cascadeOnDelete();
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
        Schema::dropIfExists('milestones_products');
    }
};
