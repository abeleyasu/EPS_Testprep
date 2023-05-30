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
            $table->integer('diff_rating')->nullable()->after('category_type')->comment('0 => Easy, 1 => Medium, 2 => Hard, 3 =>Yikes, 4 => AllUnanswered, 5 =>AllQuestions');
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
            $table->dropColumn('diff_rating');
        });
    }
};
