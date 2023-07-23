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
        if (!Schema::hasTable('question_types')) {
            Schema::create('question_types', function (Blueprint $table) {
                $table->id();
                $table->text('question_type_title')->nullable();
                $table->text('question_type_description')->nullable();
                $table->text('question_type_lesson')->nullable();
                $table->text('question_type_strategies')->nullable();
                $table->text('question_type_identification_methods')->nullable();
                $table->timestamp('deleted_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('question_types');
    }
};
