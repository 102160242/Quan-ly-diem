<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\UniversityClass;
use App\Models\Faculty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
\Maatwebsite\Excel\Imports\HeadingRowFormatter::default('none');

class StudentsImport implements ToModel, WithChunkReading, WithBatchInserts, WithHeadingRow, ShouldQueue
{
    /**
     * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;
    public function model(array $row)
    {
        //$university_class_id;
        $universityClass = UniversityClass::where("name", $row['Lớp Sinh Hoạt'])->first();
        if($universityClass == null)
        {
            $faculty = Faculty::where('name', $row['Khoa'])->first();
            if($faculty == null)
            {
                $faculty = Faculty::create(['name' => $row['Khoa']]);
            }
            $universityClass = UniversityClass::create(['name' => $row['Lớp Sinh Hoạt'], 'academic_year' => $row['Niên Khoá'], 'faculty_id' => $faculty->id]);
        }
        //else $university_class_id = $universityClass->id;
        return new Student([
            "name" => $row['Tên'],
            "gender" => $row['Giới Tính'] == "Nam" ? 1 : 0,
            "birthday" => $row['Ngày Sinh'],
            "phone_number" => $row['Số Điện Thoại'],
            "email" => $row['Email'],
            "university_class_id" => $universityClass->id,
        ]);
    }

    #region Maatwebsite\Excel\Concerns\WithChunkReading Members

    /**
     *
     * @return int
     */
    function chunkSize(): int
    {
        return 1000; // Đọc lần lượt 100 sinh viên cùng lúc
    }

    #endregion

    #region Maatwebsite\Excel\Concerns\WithBatchInserts Members

    /**
     *
     * @return int
     */
    function batchSize(): int
    {
        return 500; // Insert 100 sinh viên vào DB cùng lúc
    }

    #endregion
}
