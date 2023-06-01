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
        Schema::create('college_search_adds', function (Blueprint $table) {
            $table->id();
            $table->integer('college_lists_id')->nullable();
            $table->string('college_id')->nullable();
            $table->string('college_name')->nullable();
            $table->string('size')->nullable();
            $table->string('type_of_school')->nullable();
            $table->string('urbanicity')->nullable();
            $table->string('college_acceptance_rate')->nullable();
            $table->string('college_average_anual_cost')->nullable();
            $table->string('college_median_earnings')->nullable();
            $table->integer('order_index')->default(1);
            $table->string('option')->nullable();
            $table->string('avg_gpa')->nullable();
            $table->string('avg_sat')->nullable();
            $table->string('avg_act')->nullable();
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
        Schema::dropIfExists('college_search_adds');
    }
};
