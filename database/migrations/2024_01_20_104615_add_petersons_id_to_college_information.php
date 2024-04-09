<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('college_information', function (Blueprint $table) {
            // Add the new column
            // $table->string('petersons_id')->nullable();
            if (!Schema::hasColumn('college_information', 'petersons_id')) {
                $table->string('petersons_id')->nullable();
            }
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
            // Remove the column if needed
            $table->dropColumn('petersons_id');
        });
    }
};
