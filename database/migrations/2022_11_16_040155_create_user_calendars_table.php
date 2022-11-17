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
        Schema::create('user_calendars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->foreign('event_id')->references('id')->on('calendar_events');
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
        Schema::dropIfExists('user_calendars');
    }
};
