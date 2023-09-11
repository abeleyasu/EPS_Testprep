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
        if (!Schema::hasTable('tasks')) {
            Schema::create('tasks', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('section_id')->nullable();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('status');
                $table->tinyInteger('order')->nullable();
                $table->string('task_type')->nullable();
                $table->tinyInteger('published');
                $table->string('coverimage')->nullable();
                $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
                $table->foreignId('product_id')->nullable()->references('id')->on('product')->onDelete('cascade');
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('tasks');
    }
};
