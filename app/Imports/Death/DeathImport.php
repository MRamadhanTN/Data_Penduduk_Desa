<?php

namespace App\Imports\Death;

use App\Models\Death;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DeathImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Death([
            'NIK' => $row[1],
            'name' => $row[2],
            'gender' => $row[3],
            'place_birth' => $row[4],
            'birth_date' => $row[5],
            'job' => $row[6],
            'religion' => $row[7],
            'citizenship' => $row[8],
            'date' => $row[9],
            'time' => $row[10],
            'age' => $row[11],
            'place' => $row[12],
            'penyebab' => $row[13],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
