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
            //
            $table->boolean('display_peterson_early_action_deadline')->nullable();
            $table->boolean('display_peterson_early_decision_1_deadline')->nullable();
            $table->boolean('display_peterson_early_decision_2_deadline')->nullable();
            $table->boolean('display_peterson_regular_admission_deadline')->nullable();
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
            //
            $table->dropColumn('display_peterson_early_action_deadline');
            $table->dropColumn('display_peterson_early_decision_1_deadline');
            $table->dropColumn('display_peterson_early_decision_2_deadline');
            $table->dropColumn('display_peterson_regular_admission_deadline');
        });
    }
};