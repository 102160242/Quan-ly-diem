<?php

namespace App\Exports;

use App\Models\UniversityClass;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class UniversityClassesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, ShouldQueue, WithCustomCsvSettings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function query()
    {
        return UniversityClass::query();
    }
    #region Maatwebsite\Excel\Concerns\WithMapping Members

    /**
     *
     * @param mixed $row
     *
     * @return array
     */
    function map($universityClass): array
    {
        return [
            $universityClass->id,
            $universityClass->name,
            $universityClass->faculty ? $universityClass->faculty->name : "",
            $universityClass->academic_year,
        ];
    }

    #endregion
    public function headings(): array
    {
        return [
            'ID',
            'Tên',
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
