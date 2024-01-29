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
            Schema::table('college_information', function (Blueprint $table) {
                $table->string('AP_RECD_1ST_N')->nullable();
                $table->string('AD_DIFF_ALL')->nullable();
                $table->string('AP_DL_EACT_MON')->nullable();
                $table->string('AP_DL_EACT_DAY')->nullable();
                $table->string('AP_DL_FRSH_MON')->nullable();
                $table->string('AP_DL_FRSH_DAY')->nullable();
            });
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
            $table->dropColumn('AP_RECD_1ST_N');
            $table->dropColumn('AD_DIFF_ALL');
            $table->dropColumn('AP_DL_EACT_MON');
            $table->dropColumn('AP_DL_EACT_DAY');
            $table->dropColumn('AP_DL_FRSH_MON');
            $table->dropColumn('AP_DL_FRSH_DAY');
        });
    }
};
