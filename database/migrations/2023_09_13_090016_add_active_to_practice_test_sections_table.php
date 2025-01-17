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
        Schema::table('practice_test_sections', function (Blueprint $table) {
            $table->enum('is_active', ["0", "1"])->default("1");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('practice_test_sections', function (Blueprint $table) {
            //
        });
    }
};
