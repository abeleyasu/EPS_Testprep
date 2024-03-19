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
            // $table->string('reading_and_writing_score')->nullable();
            // $table->string('math_score')->nullable();
            // $table->string('total_score')->nullable();
            // $table->string('hours')->nullable();
            // $table->string('minutes')->nullable();
            // $table->string('seconds')->nullable();

            if (!Schema::hasColumn('user_answers', 'reading_and_writing_score')) {
                $table->string('reading_and_writing_score')->nullable();
            }

            if (!Schema::hasColumn('user_answers', 'math_score')) {
                $table->string('math_score')->nullable();
            }

            if (!Schema::hasColumn('user_answers', 'total_score')) {
                $table->string('total_score')->nullable();
            }

            if (!Schema::hasColumn('user_answers', 'hours')) {
                $table->string('hours')->nullable();
            }

            if (!Schema::hasColumn('user_answers', 'minutes')) {
                $table->string('minutes')->nullable();
            }

            if (!Schema::hasColumn('user_answers', 'seconds')) {
                $table->string('seconds')->nullable();
            }
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
