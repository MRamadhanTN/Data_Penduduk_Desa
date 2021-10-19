<?php

namespace App\Exports\Family;

use App\Models\Family;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FamilyExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Family::get();
    }

    public function map($families) : array {
        return [
            $families->id,
            $families->no_kk,
            $families->NIK,
            $families->kepala_keluarga,
        ];
    }

    public function headings() : array
    {
        return [
            '#',
            'Nomor Kartu Keluarga',
            'NIK',
            'Kepala Keluarga',
        ];
    }
}
