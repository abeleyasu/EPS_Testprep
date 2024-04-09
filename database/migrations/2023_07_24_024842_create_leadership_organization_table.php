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
        Schema::create('leadership_organization', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
        });
		
		// Insert data into the table
        $data = [
            ['name' => 'Air Patrol'],
            ['name' => 'Alliance Club'],
            ['name' => 'Art Club'],
            ['name' => 'Band'],
            ['name' => 'Boy Scouts'],
            ['name' => 'Computer Technology'],
            ['name' => 'Choir'],
            ['name' => 'Chamber Choir'],
            ['name' => 'Chamber Orchestra'],
            ['name' => 'Chess Team'],
            ['name' => 'Concert Band'],
            ['name' => 'DECA'],
            ['name' => 'Debate Team'],
            ['name' => 'Diversity Club'],
            ['name' => 'Drama Club'],
            ['name' => 'Eco Club'],
            ['name' => 'Environmental Club'],
            ['name' => 'FBLA'],
            ['name' => 'FCA'],
            ['name' => 'FFA'],
            ['name' => '4-H Club'],
            ['name' => 'Foreign Exchange'],
            ['name' => 'Gay-Straight Alliance'],
            ['name' => 'Girl Scouts'],
            ['name' => 'History Club'],
            ['name' => 'Interact Club'],
            ['name' => 'International Thespian Society'],
            ['name' => 'Jazz Band'],
            ['name' => 'Jazz Choir'],
            ['name' => 'Journalism Club'],
            ['name' => 'Junior ROTC'],
            ['name' => 'Key Club'],
            ['name' => 'Latin Club'],
            ['name' => 'Math Club'],
            ['name' => 'Math Olympiad'],
            ['name' => 'Marching Band'],
            ['name' => 'Mental Health Awareness Club'],
            ['name' => 'Mock Trial'],
            ['name' => 'Model UN'],
            ['name' => 'National Honor Society'],
            ['name' => 'National English Honor Society'],
            ['name' => 'Newspaper'],
            ['name' => 'Orchestra'],
            ['name' => 'Pitt Band'],
            ['name' => 'Phi Alpha Theta Honor Society'],
            ['name' => 'Publications'],
            ['name' => 'Robotics'],
            ['name' => 'Science Olympiad'],
            ['name' => 'Social Justice Club'],
            ['name' => 'Social Media Team'],
            ['name' => 'Spanish Club'],
            ['name' => 'Student Alliance'],
            ['name' => 'Student Council'],
            ['name' => 'Student Government'],
            ['name' => 'Student Radio/TV Club'],
            ['name' => 'Speech Team'],
            ['name' => 'Technical Theatre'],
            ['name' => 'Theatre'],
            ['name' => 'Yearbook Staff'],
        ];

        DB::table('leadership_organization')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leadership_organization');
    }
};
