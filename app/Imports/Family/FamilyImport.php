<?php

namespace App\Imports\Family;

use App\Models\Family;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FamilyImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Family([
            'no_kk' => $row[1],
            'NIK' => $row[2],
            'kepala_keluarga' => $row[3],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
