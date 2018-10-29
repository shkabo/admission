<?php

use Illuminate\Database\Seeder;

class AdmissionTypesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AdmissionTypes::class, 50)->create();
    }
}
