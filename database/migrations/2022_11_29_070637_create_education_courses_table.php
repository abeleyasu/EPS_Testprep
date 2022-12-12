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
        if (!Schema::hasTable('education_courses')) {
            Schema::create('education_courses', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->tinyInteger('course_type')->nullable()->comment('1 = IB Courses, 2 = AP Courses');
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
        Schema::dropIfExists('education_courses');
    }
};
