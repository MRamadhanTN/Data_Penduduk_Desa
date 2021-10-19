<?php

namespace App\Imports;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ResidentImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Resident([
            'NIK' => $row[1],
            'name' => $row[2],
            'place_birth' => $row[3],
            'birth' => $row[4],
            'job' => $row[5],
            'gender' => $row[6],
            'RT' => $row[7],
            'RW' => $row[8],
            'address' => $row[9],
            'provinces' => $row[10],
            'regencies' => $row[11],
            'districts' => $row[12],
            'villages' => $row[13],
            'religion' => $row[14],
            'status' => $row[15],
            'education' => $row[16],
            'blood_group' => $row[17],
            'kewarganegaraan' => $row[18],
            'category' => $row[19],
        ]);
    }

    public function StartRow(): int
    {
        return 2;
    }
}
