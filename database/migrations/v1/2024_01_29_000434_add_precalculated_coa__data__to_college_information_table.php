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
            $table->decimal('public_coa_in_state')->nullable();
            $table->decimal('public_coa_out_state')->nullable();
            $table->decimal('pvt_coa')->nullable();
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
            $table->dropColumn('public_coa_in_state');
            $table->dropColumn('public_coa_out_state');
            $table->dropColumn('pvt_coa');
        });
    }
};
