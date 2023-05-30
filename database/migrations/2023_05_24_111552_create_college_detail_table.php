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
        Schema::create('college_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('college_id')->nullable();
            $table->string('type_of_application')->nullable();
            $table->string('admission_option')->nullable();
            $table->string('number_of_essaya')->nullable();
            $table->string('admissions_deadline')->nullable();
            $table->string('ad_status')->nullable();
            $table->string('competitive_scholarship_deadline')->nullable();
            $table->string('csd_status')->nullable();
            $table->string('departmental_scholarship_deadline')->nullable();
            $table->string('dsd_status')->nullable();
            $table->string('honors_college_deadline')->nullable();
            $table->string('hcd_status')->nullable();
            $table->string('fafsa_deadline')->nullable();
            $table->string('fafsa_status')->nullable();
            $table->string('css_profile_deadline')->nullable();
            $table->string('css_status')->nullable();
            $table->string('direct_cost')->nullable();
            $table->string('merit_aid')->nullable();
            $table->string('need_based_aid')->nullable();
            $table->string('outside_schlorship_aid')->nullable();
            $table->string('cost_of_attendence')->nullable();
            $table->string('final_admissions_decision')->nullable();
            $table->boolean('is_application_checklist')->default(false);
            $table->boolean('is_completed_application')->default(false);
            $table->boolean('is_request_pay')->default(false);
            $table->boolean('is_high_school_transcript')->default(false);
            $table->boolean('is_letter_of_recommedation')->default(false);
            $table->boolean('is_your_offical_high_school_transcripts')->default(false);
            $table->boolean('is_school_report_and_counselor')->default(false);
            $table->boolean('is_test_scores_sent')->default(false);
            $table->boolean('is_letters_of_recommendation_submitted')->default(false);
            $table->boolean('is_pay_application_fee')->default(false);
            $table->boolean('is_submit_application')->default(false);
            $table->boolean('is_received_application')->default(false);
            $table->boolean('is_complete_application_type')->default(false);
            $table->boolean('is_complete_admission_open')->default(false);
            $table->boolean('is_complete_number_of_essays')->default(false);
            $table->boolean('is_complete_admission_deadline')->default(false);
            $table->boolean('is_complete_competitive_scholarship_deadline')->default(false);
            $table->boolean('is_complete_scholarship_deadline')->default(false);
            $table->boolean('is_completed_honors_college_deadline')->default(false);
            $table->boolean('is_completed_fafsa_deadline')->default(false);
            $table->boolean('is_completed_css_profile_deadline')->default(false);
            $table->boolean('is_completed_final_admissions_decision')->default(false);
            $table->boolean('is_completed_all_process')->default(false);
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
        Schema::dropIfExists('college_details');
    }
};
