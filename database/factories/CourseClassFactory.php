<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CourseClass;
use App\Models\Teacher;
use Faker\Generator as Faker;

$factory->define(CourseClass::class, function (Faker $faker) {
    $teacher_ids = Teacher::pluck('id')->toArray();
    return [
        'course_id' => rand(1, 100),
        'name' => $faker->word . $faker->numberBetween(1, 1000),
        'credits' => rand(1, 5),
        'teacher_id' => $teacher_ids[rand(0, count($teacher_ids) - 1)],
        'year' => $faker->dateTimeBetween('-5 years')->format('Y'),
        'semester' => rand(1, 3)
    ];
});
