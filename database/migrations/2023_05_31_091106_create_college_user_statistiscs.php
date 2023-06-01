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
        Schema::create('college_user_statistiscs', function (Blueprint $table) {
            $table->id();
            $table->integer('college_lists_id')->nullable();
            $table->string('unweighted_gpa')->nullable();
            $table->string('weighted_gpa')->nullable();
            $table->string('goal_psat_score')->nullable();
            $table->string('goal_act_score')->nullable();
            $table->string('goal_sat_score')->nullable();
            $table->string('final_act_score')->nullable();
            $table->string('final_sat_score')->nullable();
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
        Schema::dropIfExists('college_user_statistiscs');
    }
};
