<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_free_access')->default(true);
            $table->string('free_access_interval')->default('days');
            $table->integer('free_access_interval_count')->default(10);
            $table->timestamps();
        });

        DB::table('admin_settings')->insert([
            'is_free_access' => true,
            'free_access_interval' => 'days',
            'free_access_interval_count' => 30,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_settings');
    }
};
