<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class StudentsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, ShouldQueue, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function query()
    {
        return Student::query();
    }
    #region Maatwebsite\Excel\Concerns\WithMapping Members

    /**
     *
     * @param mixed $row
     *
     * @return array
     */
    function map($student): array
    {
        return [
            $student->id,
            $student->name,
            $student->gender ? "Nam" : "Nữ",
            $student->birthday,
            $student->phone_number,
            $student->email,
            $student->universityClass->name ? $student->universityClass->name : "",
            $student->universityClass->faculty ? $student->universityClass->faculty->name : "",
            $student->universityClass ? $student->universityClass->academic_year : ""
        ];
    }

    #endregion
    public function headings(): array
    {
        return [
            'ID',
            'Tên',
            'Giới Tính',
            'Ngày Sinh',
            'Số Điện Thoại',
            'Email',
            'Lớp Sinh Hoạt',
            'Khoa',
            'Niên Khoá'
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
