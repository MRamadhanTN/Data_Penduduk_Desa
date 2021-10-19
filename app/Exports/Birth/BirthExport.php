<?php

namespace App\Exports\Birth;

use App\Models\Birth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BirthExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Birth::get();
    }

    public function map($births) : array {
        return [
            $births->id,
            $births->name,
            $births->resident->gender,
            $births->resident->birth,
            $births->weight,
            $births->width,
            $births->father,
            $births->mother,
        ];
    }

    public function headings() : array
    {
        return [
            '#',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Berat',
            'Tinggi',
            'Ayah',
            'Ibu',
        ];
    }
}
