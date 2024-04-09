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
            $table->string('AP_DL_EDEC_1_MON')->nullable();
            $table->string('AP_DL_EDEC_1_DAY')->nullable();
            $table->string('AP_DL_EDEC_2_DAY')->nullable();
            $table->string('AP_DL_EDEC_2_MON')->nullable();
            //
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
            $table->dropColumn('AP_DL_EDEC_1_MON');
            $table->dropColumn('AP_DL_EDEC_1_DAY');
            $table->dropColumn('AP_DL_EDEC_2_DAY');
            $table->dropColumn('AP_DL_EDEC_2_MON');
        });
    }
};
