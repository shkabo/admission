<?php

use Illuminate\Database\Seeder;
use App\Roles;

class AdminUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => Roles::find(1)->where('name', 'administrator')->first()->id,
            'name' => 'Administrator',
            'email' => 'admissions@cloudhorizon.com',
            'email_verified_at' => now(),
            'phone' => '1234567890',
            'password' => bcrypt('admissions'),
            'active' => 1
        ]);
    }
}
