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
        Schema::table('cost_comparison_details', function (Blueprint $table) {
            $table->string('direct_miscellaneous_year')->nullable()->after('direct_room_board_year');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_comparison_details', function (Blueprint $table) {
            $table->dropColumn('direct_miscellaneous_year');
        });
    }
};
