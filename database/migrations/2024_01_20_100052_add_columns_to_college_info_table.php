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
            // $table->decimal('TUIT_STATE_FT_D', 10, 2)->nullable(); // In State Public College
            // $table->decimal('TUIT_NRES_FT_D', 10, 2)->nullable(); // Out State Public College
            // $table->decimal('TUIT_OVERALL_FT_D', 10, 2)->nullable(); // Private College
            // $table->decimal('FEES_FT_D', 10, 2)->nullable();
            // $table->decimal('BOOKS_RES_D', 10, 2)->nullable();
            // $table->decimal('TRANSPORT_RES_D', 10, 2)->nullable();

            if (!Schema::hasColumn('college_information', 'TUIT_STATE_FT_D')) {
                $table->decimal('TUIT_STATE_FT_D', 10, 2)->nullable()->after('college_icon');
            }

            if (!Schema::hasColumn('college_information', 'TUIT_NRES_FT_D')) {
                $table->decimal('TUIT_NRES_FT_D', 10, 2)->nullable()->after('TUIT_STATE_FT_D');
            }

            if (!Schema::hasColumn('college_information', 'TUIT_OVERALL_FT_D')) {
                $table->decimal('TUIT_OVERALL_FT_D', 10, 2)->nullable()->after('TUIT_NRES_FT_D');
            }

            if (!Schema::hasColumn('college_information', 'FEES_FT_D')) {
                $table->decimal('FEES_FT_D', 10, 2)->nullable()->after('TUIT_OVERALL_FT_D');
            }

            if (!Schema::hasColumn('college_information', 'BOOKS_RES_D')) {
                $table->decimal('BOOKS_RES_D', 10, 2)->nullable()->after('FEES_FT_D');
            }

            if (!Schema::hasColumn('college_information', 'TRANSPORT_RES_D')) {
                $table->decimal('TRANSPORT_RES_D', 10, 2)->nullable()->after('BOOKS_RES_D');
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
            $table->dropColumn('TUIT_STATE_FT_D');
            $table->dropColumn('TUIT_NRES_FT_D');
            $table->dropColumn('TUIT_OVERALL_FT_D');
            $table->dropColumn('FEES_FT_D');
            $table->dropColumn('BOOKS_RES_D');
            $table->dropColumn('TRANSPORT_RES_D');
        });
    }
};
