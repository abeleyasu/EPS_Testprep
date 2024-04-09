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
            // $table->string('AP_RECD_1ST_N')->nullable();
            // $table->string('AD_DIFF_ALL')->nullable();
            // $table->string('AP_DL_EACT_MON')->nullable();
            // $table->string('AP_DL_EACT_DAY')->nullable();
            // $table->string('AP_DL_FRSH_MON')->nullable();
            // $table->string('AP_DL_FRSH_DAY')->nullable();

            if (!Schema::hasColumn('college_information', 'AP_RECD_1ST_N')) {
                $table->string('AP_RECD_1ST_N')->nullable()->after('college_icon');
            }

            if (!Schema::hasColumn('college_information', 'AD_DIFF_ALL')) {
                $table->string('AD_DIFF_ALL')->nullable()->after('AP_RECD_1ST_N');
            }

            if (!Schema::hasColumn('college_information', 'AP_DL_EACT_MON')) {
                $table->string('AP_DL_EACT_MON')->nullable()->after('AD_DIFF_ALL');
            }

            if (!Schema::hasColumn('college_information', 'AP_DL_EACT_DAY')) {
                $table->string('AP_DL_EACT_DAY')->nullable()->after('AP_DL_EACT_MON');
            }

            if (!Schema::hasColumn('college_information', 'AP_DL_FRSH_MON')) {
                $table->string('AP_DL_FRSH_MON')->nullable()->after('AP_DL_EACT_DAY');
            }

            if (!Schema::hasColumn('college_information', 'AP_DL_FRSH_DAY')) {
                $table->string('AP_DL_FRSH_DAY')->nullable()->after('AP_DL_FRSH_MON');
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
