<?php

namespace App\Imports;

use App\Models\CourseClass;
use App\Models\Course;
use App\Models\Faculty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
\Maatwebsite\Excel\Imports\HeadingRowFormatter::default('none');

class CourseClassesImport implements ToModel, WithChunkReading, WithBatchInserts, WithHeadingRow, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable;
    public function model(array $row)
    {
        $course = Course::where("name", $row['Tên HP'])->first();
        if($course == null)
        {
            $course = Course::create(['name' => $row['Tên HP']]);
        }
        return new CourseClass([
            "course_id" => $course->id,
            "name" => $row['Tên LHP'],
            "credits" => $row['Số Tín Chỉ'],
            "teacher_id" => $row['ID Giảng Viên'],
            "year" => $row['Năm Học'],
            "semester" => $row['Học Kỳ Thứ'],
        ]);
    }

    #region Maatwebsite\Excel\Concerns\WithChunkReading Members

    /**
     *
     * @return int
     */
    function chunkSize(): int
    {
        return 1000; // Đọc lần lượt 100 hàng cùng lúc
    }

    #endregion

    #region Maatwebsite\Excel\Concerns\WithBatchInserts Members

    /**
     *
     * @return int
     */
    function batchSize(): int
    {
        return 500; // Insert 100 hàng vào DB cùng lúc
    }

    #endregion
}
