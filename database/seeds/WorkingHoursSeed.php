<?php

use Illuminate\Database\Seeder;

class WorkingHoursSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('working_hours')->insert([
            ['time' => '9AM'],
            ['time' => '10AM'],
            ['time' => '11AM'],
            ['time' => '12PM'],
            ['time' => '1PM'],
            ['time' => '2PM']
        ]);
    }
}
