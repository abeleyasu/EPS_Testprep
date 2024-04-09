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
            //
            $table->string('ASSN_ATHL_NCAA')->nullable();
            $table->string('ASSN_ATHL_NAIA')->nullable();
            $table->string('ASSN_ATHL_NCCAA')->nullable();
            $table->string('ASSN_ATHL_NJCAA')->nullable();
            $table->string('ASSN_ATHL_CIAU')->nullable();
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
            $table->dropColumn('ASSN_ATHL_NCAA');
            $table->dropColumn('ASSN_ATHL_NAIA');
            $table->dropColumn('ASSN_ATHL_NCCAA');
            $table->dropColumn('ASSN_ATHL_NJCAA');
            $table->dropColumn('ASSN_ATHL_CIAU');
        });
    }
};
