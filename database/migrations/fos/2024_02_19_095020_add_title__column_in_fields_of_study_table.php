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
            // Add the 'title' column
            $table->string('title')->after('id');
            
            // Modify the 'code' column to be non-unique
        });
    }

    public function down()
    {
        Schema::table('fields_of_study', function (Blueprint $table) {
            // Drop the 'title' column
            $table->dropColumn('title');
            
            // Modify the 'code' column to be unique again
        });
    }

};
