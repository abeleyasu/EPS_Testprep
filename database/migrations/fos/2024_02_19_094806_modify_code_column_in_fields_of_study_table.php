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
        Schema::table('fields_of_study', function (Blueprint $table) {
            $table->string('code')->unique(false)->change();
        });
    }

    public function down()
    {
        Schema::table('fields_of_study', function (Blueprint $table) {
            $table->string('code')->unique()->change();
        });
    }
};
