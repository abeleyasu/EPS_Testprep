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
        Schema::create('cost_comparisons', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('college_list_id')->nullable();
            $table->integer('college_id')->nullable();
            $table->string('total_direct_cost')->nullable();
            $table->string('total_merit_aid')->nullable();
            $table->string('total_need_based_aid')->nullable();
            $table->string('total_outside_scholarship')->nullable();
            $table->string('total_cost_attendance')->nullable();
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
        Schema::dropIfExists('cost_comparisons');
    }
};
