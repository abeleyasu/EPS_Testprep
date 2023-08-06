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
        Schema::create('milestones_user_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('milestone_id')->refrences('id')->on('milestones')->onDelete('cascade');
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
        Schema::dropIfExists('milestones_user_types');
    }
};
