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
        Schema::create('honors_achievement_awards', function (Blueprint $table) {
            $table->id();
            $table->string('award', 255)->nullable();
        });

        // Insert data into the table
        DB::table('honors_achievement_awards')->insert([
            ['id' => 1, 'award' => '1st Team All-State'],
            ['id' => 2, 'award' => '2nd Team All-State'],
            ['id' => 3, 'award' => '1st Team All-Conference'],
            ['id' => 4, 'award' => '2nd Team All-Conference'],
            ['id' => 5, 'award' => 'Honorable Mention'],
            ['id' => 6, 'award' => 'Academic Letter'],
            ['id' => 7, 'award' => 'Black Belt, Taekwondo'],
            ['id' => 8, 'award' => 'Commended Scholar'],
            ['id' => 9, 'award' => 'Eagle Scout'],
            ['id' => 10, 'award' => 'Honor Roll Recognition'],
            ['id' => 11, 'award' => 'MVP'],
            ['id' => 12, 'award' => 'National English Honor Society'],
            ['id' => 13, 'award' => 'National Merit Finalist'],
            ['id' => 14, 'award' => 'National Merit Semi-Finalist'],
            ['id' => 15, 'award' => 'National Merit Awardee'],
            ['id' => 16, 'award' => 'National Qualifier'],
            ['id' => 17, 'award' => 'Order of the Arrow, BSA Honor Society'],
            ['id' => 18, 'award' => 'Pending Salutatorian'],
            ['id' => 19, 'award' => 'Pending Valedictorian'],
            ['id' => 20, 'award' => 'Salutatorian'],
            ['id' => 21, 'award' => 'Science National Honor Society'],
            ['id' => 22, 'award' => 'Spanish National Honor Society'],
            ['id' => 23, 'award' => 'State Qualifier'],
            ['id' => 24, 'award' => 'Valedictorian'],
            ['id' => 25, 'award' => 'Volunteer Letter'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('honors_achievement_awards');
    }
};
