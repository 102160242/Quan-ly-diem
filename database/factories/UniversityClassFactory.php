<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UniversityClass;
use Faker\Generator as Faker;

$factory->define(UniversityClass::class, function (Faker $faker) {
    return [
        'name' => $faker->word . $faker->numberBetween(1, 1000),
        'academic_year' => $faker->dateTimeBetween('-5 years')->format('Y'),
        'faculty_id' => rand(1, 5)
    ];
});
