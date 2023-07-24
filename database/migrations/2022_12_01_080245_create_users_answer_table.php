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
        if (!Schema::hasTable('user_answers')) {
            Schema::create('user_answers', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->integer('section_id');
                $table->integer('question_id');
                $table->text('answer');
				$table->timestamp('deleted_at')->nullable()->onUpdate(CURRENT_TIMESTAMP);
				$table->timestamps();
                $table->text('guess');
                $table->text('flag');
				$table->text('skip')->nullable();
                $table->integer('test_id');
                
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
        Schema::dropIfExists('user_answers');
    }
};
