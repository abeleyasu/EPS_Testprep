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
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('reminder_name', 255);
            $table->integer('reminder_type_id')->nullable();
            $table->enum('frequency', ['Daily', 'Weekly', 'Monthly', 'Once']);
            $table->enum('method', ['Text', 'Email', 'Both']);
            $table->string('location', 255)->nullable();
            $table->time('when_time')->nullable();
            $table->string('before_time', 255)->nullable();
            $table->string('before_frequency', 255)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('enabled')->default(0);
            $table->integer('college_id')->nullable();
            $table->string('type', 255)->default('custom');
            $table->string('field', 255)->nullable();
            $table->tinyInteger('is_send')->default(0);
            $table->timestamps();
            $table->timestamp('updated_at')->useCurrent()->onUpdate(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reminders');
    }
};
