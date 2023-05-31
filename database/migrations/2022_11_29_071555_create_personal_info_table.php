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
        if (!Schema::hasTable('personal_info')) {
            Schema::create('personal_info', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('first_name')->nullable();
                $table->string('middle_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('nick_name')->nullable();
                $table->string('street_address_one')->nullable();
                $table->string('apartment_no')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->integer('zip_code')->nullable();
                $table->string('cell_phone')->nullable();
                $table->string('email')->nullable();
                $table->longText('social_links')->nullable();
                $table->string('parent_email_one')->nullable();
                $table->string('parent_email_two')->nullable();
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
        Schema::dropIfExists('personal_info');
    }
};
