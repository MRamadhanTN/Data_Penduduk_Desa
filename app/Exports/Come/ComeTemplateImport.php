<?php

namespace App\Exports\Come;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\FromCollection;

class ComeTemplateImport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Resident::all();
    }
}
