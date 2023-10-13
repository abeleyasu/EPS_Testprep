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
        Schema::table('practice_questions', function (Blueprint $table) {
            $table->integer('disc_value')->nullable();
            $table->integer('diff_value')->nullable();
            $table->integer('guessing_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('practice_questions', function (Blueprint $table) {
            $table->dropColumn('disc_value');
            $table->dropColumn('diff_value');
            $table->dropColumn('guessing_value');
        });
    }
};
