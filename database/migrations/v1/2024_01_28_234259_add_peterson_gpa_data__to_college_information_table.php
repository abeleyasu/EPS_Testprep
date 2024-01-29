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
        Schema::table('college_information', function (Blueprint $table) {
            //
            $table->string('FRSH_GPA')->nullable();
            $table->string('FRSH_GPA_WEIGHTED')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('college_information', function (Blueprint $table) {
            $table->drop('FRSH_GPA');
            $table->drop('FRSH_GPA_WEIGHTED');
            //
        });
    }
};
