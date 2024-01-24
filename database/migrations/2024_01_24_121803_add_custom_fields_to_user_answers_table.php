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
        Schema::table('user_answers', function (Blueprint $table) {
            $table->string('reading_and_writing_score')->nullable();
            $table->string('math_score')->nullable();
            $table->string('total_score')->nullable();
            $table->string('hours')->nullable();
            $table->string('minutes')->nullable();
            $table->string('seconds')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropColumn('reading_and_writing_score');
            $table->dropColumn('math_score');
            $table->dropColumn('total_score');
            $table->dropColumn('hours');
            $table->dropColumn('minutes');
            $table->dropColumn('seconds');
        });
    }
};
