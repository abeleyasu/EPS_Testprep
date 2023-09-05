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
        Schema::create('user_survey_emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_surveys_id')->constrained('user_surveys')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('email_type')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('user_survey_emails');
    }
};
