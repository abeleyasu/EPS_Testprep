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
        Schema::create('test_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('section_id')->nullable();
            $table->text('question_id')->nullable();
            $table->text('selected_answer')->nullable();
            $table->text('guess')->nullable();
            $table->text('flag')->nullable();
            $table->text('skip')->nullable();
            $table->unsignedInteger('test_id')->nullable();
            $table->unsignedInteger('progress_index')->nullable();
            $table->time('time_left')->nullable();
            $table->time('actual_time')->nullable();
            $table->integer('is_submit')->default(0);
            $table->dateTime('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            // Define foreign keys if needed
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('section_id')->references('id')->on('sections');
            // $table->foreign('test_id')->references('id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_progress');
    }
};
