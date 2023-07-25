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
        Schema::create('user_role_has_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->references('id')->on('user_roles')->onDelete('cascade');
            $table->foreignId('permission_id')->references('id')->on('user_permissions')->onDelete('cascade');
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
        Schema::dropIfExists('user_role_has_permissions');
    }
};
