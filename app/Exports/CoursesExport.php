<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CoursesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, ShouldQueue, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function query()
    {
        return Course::query();
    }
    #region Maatwebsite\Excel\Concerns\WithMapping Members

    /**
     *
     * @param mixed $row
     *
     * @return array
     */
    function map($course): array
    {
        return [
            $course->id,
            $course->name,
        ];
    }

    #endregion
    public function headings(): array
    {
        return [
            'ID',
            'Tên',
        ];
    }
    #region Maatwebsite\Excel\Concerns\WithCustomCsvSettings Members

    /**
     *
     * @return array
     */
    function getCsvSettings(): array
    {
        return [
            'use_bom' => true
        ];
    }

    #endregion
}
