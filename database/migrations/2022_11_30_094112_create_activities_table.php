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
        if (!Schema::hasTable('activities')) {
            Schema::create('activities', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->longText('demonstrated_data')->nullable();
                $table->longText('leadership_data')->nullable();
                $table->longText('activities_data')->nullable();
                $table->longText('athletics_data')->nullable();
                $table->longText('community_service_data')->nullable();
                $table->tinyInteger('is_draft')->default(0)->comment('0 => draft, 1 => published');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
};
