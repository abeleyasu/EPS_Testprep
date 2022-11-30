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
        Schema::create('personal_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('street_address_one');
            $table->string('street_address_two');
            $table->string('city');
            $table->string('state');
            $table->integer('zip_code');
            $table->string('cell_phone');
            $table->string('email');
            $table->json('social_links')->nullable();
            $table->string('parent_email_one');
            $table->string('parent_email_two');
            $table->tinyInteger('is_draft')->default(0)->comment('0 => draft, 1 => published');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('personal_info');
    }
};
