<?php

namespace App\Exports;

use App\Models\CourseClass;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CourseClassesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, ShouldQueue, WithCustomCsvSettings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function query()
    {
        return CourseClass::query();
    }
    #region Maatwebsite\Excel\Concerns\WithMapping Members

    /**
     *
     * @param mixed $row
     *
     * @return array
     */
    function map($courseClass): array
    {
        return [
            $courseClass->id,
            $courseClass->name,
            $courseClass->course->name ? $courseClass->course->name : "",
            $courseClass->credits,
            $courseClass->teacher_id,
            $courseClass->year,
            $courseClass->semester,
        ];
    }

    #endregion
    public function headings(): array
    {
        return [
            'ID',
            'Tên LHP',
            'Tên HP',
            'Số Tín Chỉ',
            'ID Giảng Viên',
            'Năm Học',
            'Học Kỳ Thứ',
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
