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
                $table->enum('testformat', ['ACT', 'SAT', 'PSAT'])->comment('ACT=ACT Practice Test,SAT=SAT Practice Test,PSAT=PSAT Practice Test')->default('ACT');
                $table->integer('test_source')->nullable()->default(0)->comment('0=>college_prep_system_test, 1=>official_released_test, 2=>self made test');
                $table->text('testdescription')->nullable();
                $table->enum('questionformat', ['ACT', 'SAT', 'PSAT'])->comment('ACT=ACT Question,SAT=SAT Question,PSAT=PSAT Question')->default('ACT');
                $table->string('testid');
                $table->string('is_test_completed');
                $table->string('category_type')->nullable();
                $table->string('question_type');
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
