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
        Schema::create('user_practice_test_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('practice_test_id')->references('id')->on('practice_tests')->onDelete('cascade');
            $table->integer('practice_questions_id');
            $table->integer('temp_id');
            $table->string('answer')->nullable();
            $table->string('guess')->nullable();
            $table->string('flag')->nullable();
            $table->string('skip')->nullable();
            $table->string('actual_time')->nullable();
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
        Schema::dropIfExists('user_practice_test_questions');
    }
};
