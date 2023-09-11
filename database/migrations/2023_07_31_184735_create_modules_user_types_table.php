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
        Schema::create('modules_user_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->refrences('id')->on('modules')->onDelete('cascade');
            $table->foreignId('user_role_id')->refrences('id')->on('user_roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules_user_types');
    }
};
