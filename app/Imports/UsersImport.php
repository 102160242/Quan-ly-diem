<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Faculty;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
\Maatwebsite\Excel\Imports\HeadingRowFormatter::default('none');

class UsersImport implements ToModel, WithChunkReading, WithBatchInserts, WithHeadingRow, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable;
    public function model(array $row)
    {
        return new User([
            "name" => $row['Tên'],
            "gender" => $row['Giới Tính'] == "Nam" ? 1 : 0,
            "birthday" => $row['Ngày Sinh'],
            "phone_number" => $row['Số Điện Thoại'],
            "email" => $row['Email'],
            "avatar" => $row['Avatar'],
            "password" => bcrypt("123456")
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
