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
        if (!Schema::hasTable('sections')) {
            Schema::create('sections', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->unsignedBigInteger('module_id')->nullable();
                $table->tinyInteger('order')->default(0);
                $table->string('status')->nullable();
                $table->string('coverimage');
                $table->boolean('published')->default(false);
                $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
                $table->foreignId('product_id')->nullable()->references('id')->on('product')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
