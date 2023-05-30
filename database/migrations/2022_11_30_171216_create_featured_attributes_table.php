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
        if (!Schema::hasTable('featured_attributes')) {
        Schema::create('featured_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->longText('featured_skills_data')->nullable();
            $table->longText('featured_awards_data')->nullable();
            $table->longText('featured_languages_data')->nullable();
            $table->longText('dual_citizenship_data')->nullable();
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
        Schema::dropIfExists('featured_attributes');
    }
};
