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
        if (!Schema::hasTable('practice_tests')) {
            Schema::disableForeignKeyConstraints();
            Schema::create('practice_tests', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->enum('format', ['ACT', 'SAT', 'PSAT', 'DSAT', 'DPSAT'])->comment('ACT=ACT Practice Test,SAT=SAT Practice Test,PSAT=PSAT Practice Test')->default('ACT');
                $table->integer('test_source')->nullable()->default(0)->comment('0=>college_prep_system_test, 1=>official_released_test, 2=>self made test');
                $table->text('description')->nullable();
                $table->string('tags')->nullable();
                $table->string('is_test_completed')->nullable();
                $table->integer('user_id')->nullable();
                $table->timestamps();
                $table->softDeletes();
                Schema::enableForeignKeyConstraints();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('practice_tests');
        Schema::enableForeignKeyConstraints();
    }
};
