<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('college_information', function (Blueprint $table) {
            $table->boolean('common_app')->default(true);
            $table->boolean('coalition_app')->default(true);
            $table->boolean('universal_app')->default(true);
            $table->boolean('college_system_app')->default(true);
            $table->boolean('apply_directly')->default(true);
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
            $table->dropColumn('common_app');
            $table->dropColumn('coalition_app');
            $table->dropColumn('universal_app');
            $table->dropColumn('college_system_app');
            $table->dropColumn('apply_directly');
        });
    }
};
