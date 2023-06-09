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
        Schema::table('college_information', function (Blueprint $table) {
            $table->string('sat_math_average')->nullable();
            $table->string('sat_reading_writing_average')->nullable()->after('sat_math_average');
            $table->string('act_composite_average')->nullable()->after('sat_reading_writing_average');
            $table->string('cost_of_attendance')->nullable()->after('act_composite_average');
            $table->string('tution_and_fess')->nullable()->after('cost_of_attendance');
            $table->string('room_and_board')->nullable()->after('tution_and_fess');
            $table->string('average_percent_of_need_met')->nullable()->after('room_and_board');
            $table->string('average_freshman_award')->nullable()->after('average_percent_of_need_met');
            $table->string('entrance_difficulty')->nullable()->after('average_freshman_award');
            $table->string('overall_admission_rate')->nullable()->after('entrance_difficulty');
            $table->boolean('early_action_offerd')->nullable()->after('overall_admission_rate')->default(0);
            $table->boolean('early_decision_offerd')->nullable()->after('early_action_offerd')->default(0);
            $table->string('regular_admission_deadline')->nullable()->after('early_decision_offerd');
            $table->string('locale')->nullable();
            $table->string('ownership')->nullable();
            $table->string('size')->nullable();
            $table->string('consumer_rate')->nullable();
            $table->string('earnings_median')->nullable();
            $table->string('avg_net_price_overall')->nullable();
            $table->string('gpa_average')->nullable();
            $table->string('sat_composite_score')->nullable();
            $table->longText('description')->nullable()->after('sat_composite_score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('college_information', function (Blueprint $table) {
            $table->dropColumn('sat_math_average');
            $table->dropColumn('sat_reading_writing_average');
            $table->dropColumn('act_composite_average');
            $table->dropColumn('cost_of_attendance');
            $table->dropColumn('tution_and_fess');
            $table->dropColumn('room_and_board');
            $table->dropColumn('average_percent_of_need_met');
            $table->dropColumn('average_freshman_award');
            $table->dropColumn('entrance_difficulty');
            $table->dropColumn('overall_admission_rate');
            $table->dropColumn('early_action_offerd');
            $table->dropColumn('early_decision_offerd');
            $table->dropColumn('regular_admission_deadline');
            $table->dropColumn('locale');
            $table->dropColumn('ownership');
            $table->dropColumn('size');
            $table->dropColumn('consumer_rate');
            $table->dropColumn('earnings_median');
            $table->dropColumn('avg_net_price_overall');
            $table->dropColumn('gpa_average');
            $table->dropColumn('sat_composite_score');
            $table->dropColumn('description');
        });
    }
};
