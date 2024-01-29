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
            $table->string('FRAT_1ST_P')->nullable();
            $table->string('CMPS_METRO_T')->nullable();
            $table->string('HOUS_FRSH_POLICY')->nullable();
            $table->string('HOUS_SPACES_OCCUP')->nullable();
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
            $table->dropColumn('FRAT_1ST_P');
            $table->dropColumn('CMPS_METRO_T');
            $table->dropColumn('HOUS_FRSH_POLICY');
            $table->dropColumn('HOUS_SPACES_OCCUP');
        });
    }
};
