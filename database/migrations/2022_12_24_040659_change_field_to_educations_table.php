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
        Schema::table('educations', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('current_grade')->nullable()->change();
            $table->string('month')->nullable()->change();
            $table->integer('year')->nullable()->change();
            $table->string('high_school_name')->nullable()->change();
            $table->string('high_school_city')->nullable()->change();
            $table->string('high_school_state')->nullable()->change();
            $table->string('high_school_district')->nullable()->change();
            $table->string('cumulative_gpa_unweighted')->nullable()->change();
            $table->string('cumulative_gpa_weighted')->nullable()->change();
            $table->string('class_rank')->nullable()->change();
            $table->integer('total_no_of_student')->nullable()->change();
            $table->string('ib_courses')->nullable()->change();
            $table->string('ap_courses')->nullable()->change();
            $table->longText('intended_college_major')->nullable()->change();
            $table->longText('intended_college_minor')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('educations', function (Blueprint $table) {
            //
        });
    }
};
