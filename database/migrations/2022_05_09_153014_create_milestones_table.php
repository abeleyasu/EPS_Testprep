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
        if (!Schema::hasTable('milestones')) {
            Schema::create('milestones', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('phone', 25)->nullable();
                $table->string('role')->default('user');
                $table->text('description')->nullable();
                $table->text('content')->nullable();
                $table->string('user_type')->nullable();
                $table->integer('duration')->default(0);
                $table->tinyInteger('order')->nullable();
                $table->string('status', 40)->nullable();
                $table->string('coverimage');
                $table->boolean('published')->default(false);
                $table->unsignedBigInteger('added_by');
                $table->timestamps();
                $table->softDeletes();

                // $table->foreign('added_by')->references('id')->on('users');
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
        Schema::dropIfExists('milestones');
    }
};
