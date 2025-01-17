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
        Schema::create('college_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->longText('last_search_string')->nullable();
            // for high school test score
            $table->string('high_school_test_type')->nullable()->default('ACT');
            $table->string('high_school_test_date')->nullable();
            $table->string('high_school_english_score')->nullable();
            $table->string('high_school_math_score')->nullable();
            $table->string('high_school_reading_score')->nullable();
            $table->string('high_school_science_score')->nullable();
            // for Goal score
            $table->string('goal_test_type')->nullable()->default('ACT');
            $table->string('goal_test_date')->nullable();
            $table->string('goal_english_score')->nullable();
            $table->string('goal_math_score')->nullable();
            $table->string('goal_reading_score')->nullable();
            $table->string('goal_science_score')->nullable();
            // final score
            $table->string('final_test_type')->nullable()->default('ACT');
            $table->string('final_test_date')->nullable();
            $table->string('final_english_score')->nullable();
            $table->string('final_math_score')->nullable();
            $table->string('final_reading_score')->nullable();
            $table->string('final_science_score')->nullable();
            // end
            $table->integer('active_step')->nullable()->default(1);
            $table->string('status')->nullable()->default('not_completed');
            $table->string('unweighted_gpa')->nullable();
            $table->string('weighted_gpa')->nullable();

            $table->string('high_school_composite_score')->nullable();
            $table->string('goal_composite_score')->nullable();
            $table->string('final_composite_score')->nullable();
            $table->string('final_write_score')->nullable();
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
        Schema::dropIfExists('college_lists');
    }
};
