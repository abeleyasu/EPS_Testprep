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
        Schema::table('personal_info', function (Blueprint $table) {
            $table->string('nick_name')->nullable()->after('last_name');
            $table->string('apartment_no')->nullable()->after('street_address_one');
            $table->dropColumn('street_address_two');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_info', function (Blueprint $table) {
            //
        });
    }
};
