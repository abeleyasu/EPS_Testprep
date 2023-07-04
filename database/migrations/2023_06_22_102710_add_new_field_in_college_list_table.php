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
        Schema::table('college_lists', function (Blueprint $table) {
            $table->string('unweighted_gpa')->nullable();
            $table->string('weighted_gpa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('college_lists', function (Blueprint $table) {
            $table->dropColumn('unweighted_gpa');
            $table->dropColumn('weighted_gpa');
        });
    }
};
