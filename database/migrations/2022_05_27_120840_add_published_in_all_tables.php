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
        Schema::table('milestones', function (Blueprint $table) {
            $table->boolean('published')->default(false);
        });
        Schema::table('modules', function (Blueprint $table) {
            $table->boolean('published')->default(false);
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->boolean('published')->default(false);
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->boolean('published')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('milestones', function (Blueprint $table) {
            $table->dropColumn('published');
        });
        Schema::table('modules', function (Blueprint $table) {
            $table->dropColumn('published');
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn('published');
        });
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('published');
        });
    }
};
