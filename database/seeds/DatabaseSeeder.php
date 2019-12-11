<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AcademicRanksTableSeeder::class);
        $this->call(DegreesTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(UniversityClassesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(CourseClassesTableSeeder::class);
        $this->call(ScoreColumnsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
    }
}
