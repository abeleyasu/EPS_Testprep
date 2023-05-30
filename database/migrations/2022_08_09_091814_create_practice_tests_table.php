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
        if (!Schema::hasTable('practice_tests')) {
            Schema::create('practice_tests', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->enum('testformat',['ACT','SAT','PSAT'])->comment('ACT=ACT Practice Test,SAT=SAT Practice Test,PSAT=PSAT Practice Test')->default('ACT');
                $table->text('testdescription')->nullable();
                $table->enum('questionformat',['ACT','SAT','PSAT'])->comment('ACT=ACT Question,SAT=SAT Question,PSAT=PSAT Question')->default('ACT');
                $table->string('testid');
                $table->text('questiondescription')->nullable();
                $table->softDeletes();
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
        Schema::dropIfExists('practice_tests');
    }
};
