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
            if (!Schema::hasColumn('practice_test_sections', 'easy_section_determiner')) {
                $table->text('easy_section_determiner')->nullable();
            }

            if (!Schema::hasColumn('practice_test_sections', 'medium_section_determiner')) {
                $table->text('medium_section_determiner')->nullable();
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
            //
        });
    }
};
