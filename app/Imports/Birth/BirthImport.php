<?php

namespace App\Imports\Birth;

use App\Models\Birth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BirthImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Birth([
            'name' => $row[1],
            'gender' => $row[2],
            'birth' => $row[3],
            'weight' => $row[4],
            'width' => $row[5],
            'father' => $row[6],
            'mother' => $row[7],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
