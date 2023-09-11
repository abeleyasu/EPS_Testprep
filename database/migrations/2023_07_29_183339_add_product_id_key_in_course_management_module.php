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
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->references('id')->on('product')->onDelete('cascade');
        });

        Schema::table('milestones', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->references('id')->on('product')->onDelete('cascade');
        });   

        Schema::table('modules', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->references('id')->on('product')->onDelete('cascade');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->references('id')->on('product')->onDelete('cascade');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->references('id')->on('product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['product_id']);
        });

        Schema::table('milestones', function (Blueprint $table) {
            $table->dropColumn(['product_id']);
        });

        Schema::table('modules', function (Blueprint $table) {
            $table->dropColumn(['product_id']);
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn(['product_id']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['product_id']);
        });
    }
};
