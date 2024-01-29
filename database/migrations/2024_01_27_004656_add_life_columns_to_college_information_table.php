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
            $table->string('LIFE_SOR_NAT')->nullable();
            $table->string('LIFE_SOR_LOCAL')->nullable();
            $table->string('LIFE_FRAT_NAT')->nullable();
            $table->string('LIFE_FRAT_LOCAL')->nullable();
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
            $table->dropColumn('LIFE_SOR_NAT');
            $table->dropColumn('LIFE_SOR_LOCAL');
            $table->dropColumn('LIFE_FRAT_NAT');
            $table->dropColumn('LIFE_FRAT_LOCAL');
        });
    }
};
