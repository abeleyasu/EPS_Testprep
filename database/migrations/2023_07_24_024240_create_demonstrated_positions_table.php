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
        Schema::create('demonstrated_positions', function (Blueprint $table) {
            $table->id();
            $table->string('position_name', 255);
        });

        // Insert data into the table
        DB::table('demonstrated_positions')->insert([
            ['id' => 1, 'position_name' => 'Assistant'],
            ['id' => 2, 'position_name' => 'Attendee'],
            ['id' => 3, 'position_name' => 'Barista'],
            ['id' => 4, 'position_name' => 'Busser'],
            ['id' => 5, 'position_name' => 'Chair'],
            ['id' => 6, 'position_name' => 'Captain'],
            ['id' => 7, 'position_name' => 'Chef'],
            ['id' => 8, 'position_name' => 'Co-Captain'],
            ['id' => 9, 'position_name' => 'Co-Leader'],
            ['id' => 10, 'position_name' => 'Co-Founder'],
            ['id' => 11, 'position_name' => 'Conducted Career Interview'],
            ['id' => 12, 'position_name' => 'Created'],
            ['id' => 13, 'position_name' => 'Customer Service'],
            ['id' => 14, 'position_name' => 'Employee'],
            ['id' => 15, 'position_name' => 'Developer'],
            ['id' => 16, 'position_name' => 'Director'],
            ['id' => 17, 'position_name' => 'Front of House Team Member'],
            ['id' => 18, 'position_name' => 'Founder'],
            ['id' => 19, 'position_name' => 'Intern'],
            ['id' => 20, 'position_name' => 'Internship'],
            ['id' => 21, 'position_name' => 'Initiated'],
            ['id' => 22, 'position_name' => 'Job Shadow'],
            ['id' => 23, 'position_name' => 'JV Starter'],
            ['id' => 24, 'position_name' => 'JV Member'],
            ['id' => 25, 'position_name' => 'Lead'],
            ['id' => 26, 'position_name' => 'Leader'],
            ['id' => 27, 'position_name' => 'Manager'],
            ['id' => 28, 'position_name' => 'Member'],
            ['id' => 29, 'position_name' => 'Observed'],
            ['id' => 30, 'position_name' => 'Officer'],
            ['id' => 31, 'position_name' => 'Operated'],
            ['id' => 32, 'position_name' => 'Organizer'],
            ['id' => 33, 'position_name' => 'Owner'],
            ['id' => 34, 'position_name' => 'Owner & Founder'],
            ['id' => 35, 'position_name' => 'Participant'],
            ['id' => 36, 'position_name' => 'President'],
            ['id' => 37, 'position_name' => 'Recorder'],
            ['id' => 38, 'position_name' => 'Reporter'],
            ['id' => 39, 'position_name' => 'Representative'],
            ['id' => 40, 'position_name' => 'Researcher'],
            ['id' => 41, 'position_name' => 'Scout'],
            ['id' => 42, 'position_name' => 'Secretary'],
            ['id' => 43, 'position_name' => 'Self-Employed'],
            ['id' => 44, 'position_name' => 'Shift Lead'],
            ['id' => 45, 'position_name' => 'Shift Manager'],
            ['id' => 46, 'position_name' => 'Starter'],
            ['id' => 47, 'position_name' => 'State Officer'],
            ['id' => 48, 'position_name' => 'State Representative'],
            ['id' => 49, 'position_name' => 'Summer Student'],
            ['id' => 50, 'position_name' => 'Student'],
            ['id' => 51, 'position_name' => 'Vice President'],
            ['id' => 52, 'position_name' => 'Team Manager'],
            ['id' => 53, 'position_name' => 'Treasurer'],
            ['id' => 54, 'position_name' => 'Varsity Starter'],
            ['id' => 55, 'position_name' => 'Varsity Member'],
            ['id' => 56, 'position_name' => 'Volunteer'],
            ['id' => 57, 'position_name' => 'Worker']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demonstrated_positions');
    }
};
