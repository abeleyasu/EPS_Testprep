<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToCollegeInformation extends Migration
{
    public function up()
    {
        Schema::table('college_information', function (Blueprint $table) {
            // Fraternity-related fields
            $table->boolean('has_national_fraternities')->default(false);
            $table->boolean('has_local_fraternities')->default(false);
            $table->float('percent_freshmen_join_fraternities')->nullable();
            $table->float('percent_men_join_fraternities')->nullable();

            // Sorority-related fields
            $table->string('academic_calendar_system')->nullable();
            $table->float('percent_women_join_sororities')->nullable();
            $table->float('percent_freshmen_join_sororities')->nullable();
            $table->boolean('has_local_sororities')->default(false);
            $table->boolean('has_national_sororities')->default(false);

            // Athletics-related fields
            $table->boolean('ncaa')->default(false);
            $table->boolean('naia')->default(false);
            $table->boolean('nccaa')->default(false);
            $table->boolean('njcaa')->default(false);

            // Housing and Location fields
            $table->integer('num_students_in_housing')->nullable();
            $table->boolean('freshman_housing_guarantee')->default(false);
            $table->string('nearest_metropolitan_area')->nullable();
            $table->integer('city_population')->nullable();

            // Admission and GPA fields
            $table->string('entrance_difficulty_out_of_state')->nullable();
            $table->string('entrance_difficulty_overall')->nullable();
            $table->float('average_weighted_gpa')->nullable();
            $table->float('average_unweighted_gpa')->nullable();

            // Financial aid and Scholarship deadlines
            $table->string('css_profile_deadline')->nullable();
            $table->string('fafsa_deadline')->nullable();
            $table->string('competitive_scholarship_deadline')->nullable();

            // Admission deadlines
            $table->boolean('rolling_admission')->default(false);
            $table->string('rolling_admission_day')->nullable();
            $table->string('rolling_admission_month')->nullable();
            $table->string('rolling_admission_month_day')->nullable();
            $table->boolean('regular_decision')->default(false);
            $table->string('regular_decision_day')->nullable();
            $table->string('regular_decision_month')->nullable();
            $table->boolean('early_decision_ii')->default(false);
            $table->string('early_decision_ii_day')->nullable();
            $table->string('early_decision_ii_month')->nullable();
            $table->boolean('early_decision_i')->default(false);
            $table->string('early_decision_i_day')->nullable();
            $table->string('early_decision_i_month')->nullable();
            $table->boolean('early_action')->default(false);
            $table->string('early_action_day')->nullable();
            $table->string('early_action_month')->nullable();

            // Admission statistics
            $table->integer('num_applications')->nullable();

        });
    }

    public function down()
    {
        Schema::table('college_information', function (Blueprint $table) {
            // Drop all the added columns
            $table->dropColumn([
                'has_national_fraternities',
                'has_local_fraternities',
                'percent_freshmen_join_fraternities',
                'percent_men_join_fraternities',
                'academic_calendar_system',
                'percent_women_join_sororities',
                'percent_freshmen_join_sororities',
                'has_local_sororities',
                'has_national_sororities',
                'ncaa',
                'naia',
                'nccaa',
                'njcaa',
                'num_students_in_housing',
                'freshman_housing_guarantee',
                'nearest_metropolitan_area',
                'city_population',
                'entrance_difficulty_out_of_state',
                'entrance_difficulty_overall',
                'average_weighted_gpa',
                'average_unweighted_gpa',
                'css_profile_deadline',
                'fafsa_deadline',
                'competitive_scholarship_deadline',
                'rolling_admission',
                'rolling_admission_day',
                'rolling_admission_month',
                'rolling_admission_month_day',
                'regular_decision',
                'regular_decision_day',
                'regular_decision_month',
                'early_decision_ii',
                'early_decision_ii_day',
                'early_decision_ii_month',
                'early_decision_i',
                'early_decision_i_day',
                'early_decision_i_month',
                'early_action',
                'early_action_day',
                'early_action_month',
                'num_applications',
                'overall_admission_rate',
            ]);
        });
    }
}
