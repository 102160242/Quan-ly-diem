<?php

use Illuminate\Database\Seeder;

class UniversityClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\UniversityClass::class, 30)->create();
    }
}
