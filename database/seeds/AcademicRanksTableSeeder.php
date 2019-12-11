<?php

use Illuminate\Database\Seeder;
use App\Models\AcademicRank;

class AcademicRanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AcademicRank::create([
            'name' => "Phó giáo sư",
        ]);
        AcademicRank::create([
            'name' => "Giáo sư",
        ]);
    }
}
