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
        Schema::create('athletics_positions', function (Blueprint $table) {
            $table->id();
            $table->string('position', 255);
        });
		
		// Insert data into the table
        $data = [
            ['position' => 'Aerobatics'],
            ['position' => 'Archery'],
            ['position' => 'Baseball Team'],
            ['position' => 'Basketball Team'],
            ['position' => 'Bowling Team'],
            ['position' => 'Cheer Team'],
            ['position' => 'Chess Team'],
            ['position' => 'Competitive Cheer & Dance Team'],
            ['position' => 'Cross Country Team'],
            ['position' => 'Cycling Team'],
            ['position' => 'Dance Team'],
            ['position' => 'Field Hockey Team'],
            ['position' => 'Frisbee Golf Team'],
            ['position' => 'Football Team'],
            ['position' => 'Gymnastics Team'],
            ['position' => 'Golf Team'],
            ['position' => 'Hiking'],
            ['position' => 'Ice Hockey Team'],
            ['position' => 'Lacrosse Team'],
            ['position' => 'Mascot'],
            ['position' => 'Mountain Biking Team'],
            ['position' => 'Rugby Team'],
            ['position' => 'Rock Climbing'],
            ['position' => 'Skiing'],
            ['position' => 'Ski Team'],
            ['position' => 'Swim Team'],
            ['position' => 'Swim & Dive Team'],
            ['position' => 'Soccer Team'],
            ['position' => 'Tennis Team'],
            ['position' => 'Track & Field Team'],
            ['position' => 'Volleyball Team'],
            ['position' => 'Water Polo Team'],
        ];

        DB::table('athletics_positions')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athletics_positions');
    }
};
