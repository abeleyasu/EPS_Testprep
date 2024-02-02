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
            $table->decimal('public_coa_in_state_admin')->nullable();
            $table->decimal('public_coa_out_state_admin')->nullable();
            $table->decimal('pvt_coa_admin')->nullable();
            $table->string('display_peterson_public_coa')->nullable();
            $table->string('display_peterson_pvt_coa')->nullable();


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
            $table->dropColumn('public_coa_in_state_admin');
            $table->dropColumn('public_coa_out_state_admin');
            $table->dropColumn('pvt_coa_admin');
            $table->dropColumn('display_peterson_public_coa');
            $table->dropColumn('display_peterson_pvt_coa');
        });
    }
};
