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
        Schema::create('honors_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status', 255);
        });
		
		// Insert data into the table
        DB::table('honors_statuses')->insert([
            ['id' => 1, 'status' => 'Appointed'],
            ['id' => 2, 'status' => 'Assigned'],
            ['id' => 3, 'status' => 'Awardee'],
            ['id' => 4, 'status' => 'Awarded'],
            ['id' => 5, 'status' => 'Created'],
            ['id' => 6, 'status' => 'Developed'],
            ['id' => 7, 'status' => 'Earned'],
            ['id' => 8, 'status' => 'Elected'],
            ['id' => 9, 'status' => 'Finalist'],
            ['id' => 10, 'status' => 'Member'],
            ['id' => 11, 'status' => 'Nominated'],
            ['id' => 12, 'status' => 'Recipient'],
            ['id' => 13, 'status' => 'Runner-Up'],
            ['id' => 14, 'status' => 'Selected'],
            ['id' => 15, 'status' => 'Semi-Finalist'],
            ['id' => 16, 'status' => 'Co-Founded'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('honors_statuses');
    }
};
