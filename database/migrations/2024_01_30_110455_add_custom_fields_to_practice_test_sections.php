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
            // $table->string('lower_value')->nullable();
            // $table->string('upper_value')->nullable();

            if (!Schema::hasColumn('practice_test_sections', 'lower_value')) {
                $table->string('lower_value')->nullable();
            }

            if (!Schema::hasColumn('practice_test_sections', 'upper_value')) {
                $table->string('upper_value')->nullable();
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
        Schema::table('practice_test_sections', function (Blueprint $table) {
            $table->dropColumn('lower_value')->nullable();
            $table->dropColumn('upper_value')->nullable();
        });
    }
};
