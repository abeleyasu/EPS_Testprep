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
        if (!Schema::hasTable('practice_questions')) {
            Schema::create('practice_questions', function (Blueprint $table) {
                $table->id();
                $table->enum('format', ['ACT', 'SAT', 'PSAT'])->comment('ACT=ACT Question,SAT=SAT Question,PSAT=PSAT Question')->default('ACT');
                $table->string('testid');
                $table->integer('question_type_id')->nullable();
                $table->string('category_type')->nullable();
                $table->text('description')->nullable();
                $table->integer('diff_rating')->nullable()->comment('0 => Easy, 1 => Medium, 2 => Hard, 3 =>Yikes, 4 => AllUnanswered, 5 =>AllQuestions');
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
        Schema::dropIfExists('practice_questions');
    }
};
