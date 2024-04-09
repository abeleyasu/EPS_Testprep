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
        if (!Schema::hasTable('question_types')) {
            Schema::create('question_types', function (Blueprint $table) {
                $table->id();
                $table->text('question_type_title')->nullable();
                $table->integer('selfMade')->default(0)->comment('0: No selfmade, 1: selfmade');
                $table->string('format')->nullable();
                $table->string('section_type')->nullable();
                $table->text('question_type_description')->nullable();
                $table->text('question_type_lesson')->nullable();
                $table->text('question_type_strategies')->nullable();
                $table->text('question_type_identification_methods')->nullable();
                $table->text('question_type_identification_activity')->nullable();
                $table->integer('super_category_id')->nullable();
                $table->integer('category_id')->nullable();
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
        Schema::dropIfExists('question_types');
    }
};
