<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class UsersExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, ShouldQueue, WithCustomCsvSettings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function query()
    {
        return User::query();
    }
    #region Maatwebsite\Excel\Concerns\WithMapping Members

    /**
     *
     * @param mixed $row
     *
     * @return array
     */
    function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->gender ? "Nam" : "Nữ",
            $user->birthday,
            $user->phone_number,
            $user->email,
            $user->avatar,
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
            'Avatar',
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
