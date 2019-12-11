<?php

use Illuminate\Database\Seeder;
use App\Models\Degree;

class DegreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Degree::create([
            'name' => "Cử nhân",
        ]);
        Degree::create([
            'name' => "Kỹ sư",
        ]);
        Degree::create([
            'name' => "Thạc sỹ",
        ]);
        Degree::create([
            'name' => "Tiến sỹ",
        ]);
    }
}
