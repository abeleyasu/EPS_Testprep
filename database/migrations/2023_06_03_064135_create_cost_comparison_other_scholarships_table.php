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
        Schema::create('cost_comparison_other_scholarships', function (Blueprint $table) {
            $table->id();
            $table->integer('cost_comparison_id')->nullable();
            $table->integer('cost_aid_type_id')->nullable();
            $table->string('name')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('cost_comparison_other_scholarships');
    }
};
