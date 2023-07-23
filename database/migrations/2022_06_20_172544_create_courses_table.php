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
        if (!Schema::hasTable('courses')) {
            Schema::create('courses', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->integer('published');
                $table->string('content')->nullable();
                $table->string('user_type');
                $table->string('status');
                $table->integer('duration');
                $table->integer('order');
                $table->string('coverimage');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        Schema::table('milestones', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable();

            $table->foreign('course_id')
                ->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
