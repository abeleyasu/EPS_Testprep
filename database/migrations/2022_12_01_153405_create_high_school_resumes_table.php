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
        if (!Schema::hasTable('high_school_resumes')) {
        Schema::create('high_school_resumes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('personal_info_id');
            $table->unsignedBigInteger('education_id');
            $table->unsignedBigInteger('honor_id');
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('employment_certification_id');
            $table->unsignedBigInteger('featured_attribute_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('personal_info_id')->references('id')->on('personal_info')->onDelete('cascade');
            $table->foreign('education_id')->references('id')->on('educations')->onDelete('cascade');
            $table->foreign('honor_id')->references('id')->on('honors')->onDelete('cascade');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('employment_certification_id')->references('id')->on('employment_certifications')->onDelete('cascade');
            $table->foreign('featured_attribute_id')->references('id')->on('featured_attributes')->onDelete('cascade');
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
        Schema::dropIfExists('high_school_resumes');
    }
};
