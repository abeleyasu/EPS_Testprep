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
                $table->string('title')->nullable();
                $table->enum('format', ['ACT', 'SAT', 'PSAT'])->comment('ACT=ACT Question,SAT=SAT Question,PSAT=PSAT Question')->default('ACT');
                $table->integer('practice_test_sections_id')->nullable();
                $table->string('type')->nullable();
                $table->integer('passages_id')->nullable();
                $table->text('passages')->nullable();
                $table->integer('passage_number')->nullable();
                $table->string('answer')->nullable();
                $table->text('answer_content')->nullable();
                $table->text('answer_exp')->nullable();
                $table->string('fill')->nullable();
                $table->string('fillType')->nullable();
                $table->string('multiChoice')->nullable();
                $table->tinyInteger('question_order')->nullable();
                $table->string('tags')->nullable();
                $table->integer('question_type_id')->nullable();
                $table->string('category_type')->nullable();
                $table->longText('is_category_checked')->nullable();
                $table->integer('diff_rating')->nullable()->comment('0 => Easy, 1 => Medium, 2 => Hard, 3 =>Yikes, 4 => AllUnanswered, 5 =>AllQuestions');
                $table->text('super_category')->nullable();
                $table->integer('selfMade')->nullable()->comment('0: No selfmade, 1: selfmade');
                $table->integer('test_source')->nullable();
                $table->text('checkbox_values')->nullable();
                $table->text('super_category_values')->nullable();
                $table->text('category_type_values')->nullable();
                $table->text('question_type_values')->nullable();
                $table->enum("mistake_type", ["content_misunderstanding", "random_error", "timing_issue"])->nullable();
                $table->text('notes')->nullable();
                $table->integer('parent_id')->nullable();
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
        Schema::dropIfExists('practice_questions');
    }
};
