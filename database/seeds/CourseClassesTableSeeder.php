<?php

use Illuminate\Database\Seeder;

class CourseClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CourseClass::class, 500)->create();
    }
}
