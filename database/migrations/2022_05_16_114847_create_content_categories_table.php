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
        if (!Schema::hasTable('content_categories')) {
            Schema::create('content_categories', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
        
        Schema::table('milestones', function (Blueprint $table) {
            $table->unsignedBigInteger('content_category_id')->nullable();

            $table->foreign('content_category_id')
                ->references('id')->on('content_categories')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('milestones', function (Blueprint $table) {
            $table->dropForeign(['content_category_id']);
            $table->dropColumn('content_category_id');
        });

        Schema::dropIfExists('content_categories');
    }
};
