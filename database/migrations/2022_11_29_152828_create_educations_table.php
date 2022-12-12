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
        if (!Schema::hasTable('educations')) {
            Schema::create('educations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('current_grade');
                $table->string('month');
                $table->integer('year');
                $table->string('high_school_name');
                $table->string('high_school_city');
                $table->string('high_school_state');
                $table->string('high_school_district');
                $table->tinyInteger('is_graduate')->default(0)->comment('0 = not graduate, 1 = graduate');
                $table->string('grade_level')->nullable();
                $table->string('college_name')->nullable();
                $table->string('college_city')->nullable();
                $table->string('college_state')->nullable();
                $table->string('cumulative_gpa_unweighted');
                $table->string('cumulative_gpa_weighted');
                $table->string('class_rank');
                $table->integer('total_no_of_student');
                $table->string('ib_courses');
                $table->string('ap_courses');
                $table->longText('course_data')->nullable();
                $table->longText('honor_course_data')->nullable();
                $table->longText('testing_data')->nullable();
                $table->string('intended_college_major');
                $table->string('intended_college_minor');
                $table->tinyInteger('is_draft')->default(0)->comment('0 => draft, 1 => published');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('educations');
    }
};
