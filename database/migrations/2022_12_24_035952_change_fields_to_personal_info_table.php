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
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->string('first_name')->nullable()->change();
            $table->string('middle_name')->nullable()->change();
            $table->string('last_name')->nullable()->change();
            $table->string('nick_name')->nullable()->change();
            $table->string('street_address_one')->nullable()->change();
            $table->string('street_address_two')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('state')->nullable()->change();
            $table->integer('zip_code')->nullable()->change();
            $table->string('cell_phone')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('parent_email_one')->nullable()->change();
            $table->string('parent_email_two')->nullable()->change();
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
