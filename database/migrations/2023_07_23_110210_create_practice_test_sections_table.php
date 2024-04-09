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
        Schema::create('practice_test_sections', function (Blueprint $table) {
            $table->id();
            $table->string('format')->nullable();
            $table->string('practice_test_type')->nullable();
            $table->integer('testid')->nullable();
            $table->integer('section_order')->nullable();
            $table->string('is_section_completed')->nullable();
            $table->string('section_title')->nullable();
            $table->time('regular_time')->nullable();
            $table->time('fifty_per_extended')->nullable();
            $table->time('hundred_per_extended')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('practice_test_sections');
    }
};
