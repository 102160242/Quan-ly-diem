<?php

use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faculty::create([
            'name' => "Công nghệ thông tin",
        ]);
        Faculty::create([
            'name' => "Điện tử - Viễn thông",
        ]);
        Faculty::create([
            'name' => "Cơ khí",
        ]);
        Faculty::create([
            'name' => "Cầu đường",
        ]);
        Faculty::create([
            'name' => "Môi trường",
        ]);
    }
}
