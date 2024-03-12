<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEarlyDecisionDeadlinesToCollegeInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('college_information', function (Blueprint $table) {
            $table->date('early_decision_1_deadline')->nullable();
            $table->date('early_decision_2_deadline')->nullable();
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
            $table->dropColumn('early_decision_1_deadline');
            $table->dropColumn('early_decision_2_deadline');
        });
    }
}
