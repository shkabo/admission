<?php

use Faker\Generator as Faker;

$factory->define(\App\AdmissionTypes::class, function (Faker $faker) {
    return [
        'name' => $faker->numerify('Admission interview #####'),
        'description' => $faker->text($maxNbChars = 150),
        'status' => random_int(0,1)
    ];
});
