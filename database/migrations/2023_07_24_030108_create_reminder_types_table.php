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
        Schema::create('reminder_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
        });
		
		// Insert data into the table
        $data = [
            ['name' => 'Study'],
            ['name' => 'Take Practice Test'],
            ['name' => 'Tutoring Session'],
            ['name' => 'Counseling Session'],
        ];

        DB::table('reminder_types')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reminder_types');
    }
};
