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
            $table->string('display_peterson_weighted_gpa')->change();
            $table->string('display_peterson_unweighted_gpa')->change();
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
            //
            $table->boolean('display_peterson_weighted_gpa')->change();
            $table->boolean('display_peterson_unweighted_gpa')->change();
        });
    }
};
