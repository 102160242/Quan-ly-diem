<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ScoreColumn;

class ScoreColumnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 100; $i++)
        {
            ScoreColumn::create([
                'name' => "Bài tập",
                'course_class_id' => $i + 1,
                'ratio' => 0.2
            ]);
            ScoreColumn::create([
                'name' => "Giữa kỳ",
                'course_class_id' => $i + 1,
                'ratio' => 0.2
            ]);
            ScoreColumn::create([
                'name' => "Cuối kỳ",
                'course_class_id' => $i + 1,
                'ratio' => 0.6
            ]);
        }
    }
}
