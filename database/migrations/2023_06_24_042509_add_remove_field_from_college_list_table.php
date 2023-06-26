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
        Schema::table('college_lists', function (Blueprint $table) {
            $table->string('high_school_composite_score')->nullable()->after('high_school_science_score');
            $table->string('goal_composite_score')->nullable()->after('goal_science_score');
            $table->string('final_composite_score')->nullable()->after('final_science_score');
            $table->dropColumn('high_school_math_with_no_calculator_score');
            $table->dropColumn('high_school_math_with_calculator_score');
            $table->dropColumn('goal_math_with_no_calculator_score');
            $table->dropColumn('goal_math_with_calculator_score');
            $table->dropColumn('final_math_with_no_calculator_score');
            $table->dropColumn('final_math_with_calculator_score');
            $table->dropColumn('past_current_test_type');
            $table->dropColumn('past_current_test_date');
            $table->dropColumn('past_current_english_score');
            $table->dropColumn('past_current_math_score');
            $table->dropColumn('past_current_reading_score');
            $table->dropColumn('past_current_science_score');
            $table->dropColumn('past_current_write_score');
            $table->dropColumn('past_current_math_with_no_calculator_score');
            $table->dropColumn('past_current_math_with_calculator_score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('college_lists', function (Blueprint $table) {
            // $table->dropColumn('high_school_composite_score');
            // $table->dropColumn('goal_composite_score');
            // $table->dropColumn('final_composite_score');
        });
    }
};
