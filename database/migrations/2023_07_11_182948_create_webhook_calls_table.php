<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('webhook_calls', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('url');
            $table->text('headers')->nullable();
            $table->text('payload')->nullable();
            $table->text('exception')->nullable();

            $table->timestamps();
        });
    }
};
