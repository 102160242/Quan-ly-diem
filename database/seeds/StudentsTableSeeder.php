<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Student::class, 1000)->create()->each(function ($student) {
            $rand_ids = range(1, 500, 1);
            shuffle($rand_ids);
            $ids = array_slice($rand_ids, 0, rand(5, 20));
            foreach($ids as $id)
            {
                $courseClass = App\Models\CourseClass::find($id);
                $student->courseClasses()->save($courseClass);
            }
        });
    }
}
