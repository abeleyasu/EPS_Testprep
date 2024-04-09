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
        Schema::table('college_details', function (Blueprint $table) {
            // add is_admission_deadline_from_user column
            $table->boolean('is_admission_deadline_from_user')->default(false)->after('admissions_deadline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('college_details', function (Blueprint $table) {
            // drop is_admission_deadline_from_user column
            $table->dropColumn('is_admission_deadline_from_user');
        });
    }
};
