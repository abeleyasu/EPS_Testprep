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
        Schema::table('intended_college_lists', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->after('type')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('intended_college_lists', function (Blueprint $table) {
            if (Schema::hasColumn('intended_college_lists', 'user_id')) {
                $table->dropForeign(['intended_college_lists_user_id_foreign']);
                $table->dropColumn('user_id');
            }
        });
    }
};
