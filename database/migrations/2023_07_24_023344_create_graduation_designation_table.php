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
        Schema::create('graduation_designation', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 255);
        });

        // Insert data into the table
        DB::table('graduation_designation')->insert([
            ['id' => 1, 'designation' => 'STEM Scholar'],
            ['id' => 2, 'designation' => 'IB Diploma Candidate'],
            ['id' => 3, 'designation' => 'Business Certification'],
            ['id' => 4, 'designation' => 'Conservatory Arts Certification'],
            ['id' => 5, 'designation' => 'Summa Cum Laude'],
            ['id' => 6, 'designation' => 'Magna Cum Laude'],
            ['id' => 7, 'designation' => 'Cum Laude'],
            ['id' => 8, 'designation' => 'Valedictorian'],
            ['id' => 9, 'designation' => 'Salutatorian'],
            ['id' => 10, 'designation' => 'TEST DESIGNATION'],
            ['id' => 11, 'designation' => 'Honor Designation'],
            ['id' => 12, 'designation' => 'Good Student'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('graduation_designation');
    }
};
