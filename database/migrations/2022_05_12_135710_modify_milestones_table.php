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
            $table->text('content')->nullable();
            $table->string('user_type')->nullable();
            $table->integer('duration')->default(0);
            $table->tinyInteger('order')->nullable();
            $table->string('status',40)->nullable();
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
            $table->dropColumn('content');
            $table->dropColumn('user_type');
            $table->dropColumn('duration');
            $table->dropColumn('order');
            $table->dropColumn('status');
        });
    }
};
