<?php

namespace App\Imports;

use App\Models\UniversityClass;
use App\Models\Faculty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

\Maatwebsite\Excel\Imports\HeadingRowFormatter::default('none');

class UniversityClassesImport implements ToModel, WithChunkReading, WithBatchInserts, WithHeadingRow, ShouldQueue, SkipsOnFailure, SkipsOnError
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable, SkipsErrors;
    public function model(array $row)
    {
        $faculty = Faculty::where('name', $row['Khoa'])->first();
        if($faculty == null)
        {
            $faculty = Faculty::create(['name' => $row['Khoa']]);
        }

        return new UniversityClass([
            "name" => $row['Tên'],
            "academic_year" => $row['Niên Khoá'],
            "faculty_id" => $faculty->id,
        ]);
    }

    #region Maatwebsite\Excel\Concerns\WithChunkReading Members

    /**
     *
     * @return int
     */
    function chunkSize(): int
    {
        return 1000; // Đọc lần lượt 100 LSH cùng lúc
    }

    #endregion

    #region Maatwebsite\Excel\Concerns\WithBatchInserts Members

    /**
     *
     * @return int
     */
    function batchSize(): int
    {
        return 500; // Insert 100 LSH vào DB cùng lúc
    }

    #endregion

    #region Maatwebsite\Excel\Concerns\SkipsOnFailure Members

    /**
     *
     * @param Failure $failures
     */
    function onFailure(Failure ...$failures)
    {
    }

    #endregion

    #region Maatwebsite\Excel\Concerns\SkipsOnError Members

    /**
     *
     * @param \Throwable $e
     */
    function onError(\Throwable $e)
    {

    }

    #endregion
}
