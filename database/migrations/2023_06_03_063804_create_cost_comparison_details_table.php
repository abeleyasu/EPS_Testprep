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
        Schema::create('cost_comparison_details', function (Blueprint $table) {
            $table->id();
            $table->integer('cost_comparison_id')->nullable();
            $table->string('direct_tuition_free_year')->nullable();
            $table->string('direct_room_board_year')->nullable();
            $table->string('institutional_academic_merit_aid')->nullable();
            $table->string('institutional_exchange_program_scho')->nullable();
            $table->string('institutional_honors_col_program')->nullable();
            $table->string('institutional_academic_department_scho')->nullable();
            $table->string('institutional_atheletic_scho')->nullable();
            $table->string('institutional_other_talent_scho')->nullable();
            $table->string('institutional_diversity_scho')->nullable();
            $table->string('institutional_legacy_scho')->nullable();
            $table->string('institutional_other_scho')->nullable();
            $table->string('need_base_federal_grants')->nullable();
            $table->string('need_base_institutional_grants')->nullable();
            $table->string('need_base_state_grants')->nullable();
            $table->string('need_base_work_study_grants')->nullable();
            $table->string('need_base_student_loans_grants')->nullable();
            $table->string('need_base_parent_plus_grants')->nullable();
            $table->string('need_base_other_grants')->nullable();
            $table->string('cost_of_attendance_year')->nullable();
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
        Schema::dropIfExists('cost_comparison_details');
    }
};
