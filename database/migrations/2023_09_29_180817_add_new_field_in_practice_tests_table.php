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
        Schema::table('practice_tests', function (Blueprint $table) {
            $table->enum('status', ['paid', 'unpaid'])->nullable()->after('user_id')->default('unpaid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('practice_tests', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
