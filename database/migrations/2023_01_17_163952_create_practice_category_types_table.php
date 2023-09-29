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
        if (!Schema::hasTable('practice_category_types')) {
            Schema::create('practice_category_types', function (Blueprint $table) {
                $table->id();
                $table->string('category_type_title');
                $table->integer('selfMade')->default(0);
                $table->string('format')->nullable();
                $table->string('section_type')->nullable();
                $table->text('category_type_description')->nullable();
                $table->longText('category_type_lesson')->nullable();
                $table->longText('category_type_strategies')->nullable();
                $table->longText('category_type_identification_methods')->nullable();
                $table->longText('category_type_identification_activity')->nullable();
                $table->integer('super_category_id')->nullable();
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('practice_category_types');
    }
};
