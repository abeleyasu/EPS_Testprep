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
        if (!Schema::hasTable('college_information')) {
            Schema::create('college_information', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('sat_math_average')->nullable();
                $table->string('sat_reading_writing_average')->nullable();
                $table->string('act_composite_average')->nullable();
                $table->string('cost_of_attendance')->nullable();
                $table->string('tution_and_fess')->nullable();
                $table->string('room_and_board')->nullable();
                $table->string('average_percent_of_need_met')->nullable();
                $table->string('average_freshman_award')->nullable();
                $table->string('entrance_difficulty')->nullable();
                $table->string('overall_admission_rate')->nullable();
                $table->boolean('early_action_offerd')->nullable()->default(0);
                $table->boolean('early_decision_offerd')->nullable()->default(0);
                $table->string('regular_admission_deadline')->nullable();
                $table->string('locale')->nullable();
                $table->string('ownership')->nullable();
                $table->string('size')->nullable();
                $table->string('consumer_rate')->nullable();
                $table->string('earnings_median')->nullable();
                $table->string('avg_net_price_overall')->nullable();
                $table->string('gpa_average')->nullable();
                $table->string('sat_composite_score')->nullable();
                $table->longText('description')->nullable();
                $table->string('avg_act_score')->nullable();
                $table->string('avg_sat_score')->nullable();
                $table->string('college_icon')->nullable();
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
        Schema::dropIfExists('college_information');
    }
};
