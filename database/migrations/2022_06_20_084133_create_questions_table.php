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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('format',['MC','TR'])->comment('MC=multiple choice,TR=text response')->default('MC');
            /*$table->unsignedInteger('passage_id')->default(0);
            $table->foreign('passage_id')
                ->references('id')
                ->on('passages')
                ->onDelete('cascade');*/ // uncomment it when passages table is done
            $table->integer('passage_id')->default(0); // remove it when passages table is done
            $table->tinyInteger('order')->nullable();
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
        Schema::dropIfExists('questions');
    }
};
