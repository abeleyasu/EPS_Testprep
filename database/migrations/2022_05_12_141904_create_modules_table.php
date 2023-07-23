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
        if (!Schema::hasTable('modules')) {
            Schema::create('modules', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->text('content')->nullable();
                $table->tinyInteger('order')->default(0);
                $table->unsignedBigInteger('milestone_id');
                $table->unsignedBigInteger('added_by');
                $table->string('coverimage');
                $table->boolean('published')->default(false);
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('milestone_id')->references('id')->on('milestones')->onDelete('cascade');
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
        Schema::dropIfExists('modules');
    }
};
