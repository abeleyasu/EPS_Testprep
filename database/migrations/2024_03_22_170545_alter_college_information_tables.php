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
            $table->string('tuition_and_fee_instate')->nullable()->after('tution_and_fess');
            $table->string('tuition_and_fee_outstate')->nullable()->after('tuition_and_fee_instate');
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
            $table->dropColumn('tuition_and_fee_instate');
            $table->dropColumn('tuition_and_fee_outstate');
        });
    }
};
