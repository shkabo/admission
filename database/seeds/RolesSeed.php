<?php

use Illuminate\Database\Seeder;

class RolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'administrator'],
            ['name' => 'staff'],
            ['name' => 'student'],
        ]);
    }
}
