<?php

namespace App\Imports\Transfer;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\ToModel;

class TransferImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Resident([
            //
        ]);
    }
}
