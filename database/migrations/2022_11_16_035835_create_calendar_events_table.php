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
        if (!Schema::hasTable('calendar_events')) {
            Schema::create('calendar_events', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
				$table->bigInteger('reminders_id')->default(0);
                $table->string('title', 191);
				$table->string('description', 250)->nullable();
                $table->string('color',7)->nullable();
                $table->tinyInteger('is_assigned')->default(0)->comment("0 = not assigned, 1 = assigned");
				$table->time('event_time')->nullable();
				$table->string('google_calendar_event_id', 255)->nullable();
                $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('calendar_events');
    }
};
