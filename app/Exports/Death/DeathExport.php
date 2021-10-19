<?php

namespace App\Exports\Death;

use App\Models\Death;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DeathExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Death::get();
    }

     public function map($dies) : array {
        return [
            $dies->id,
            $dies->resident->NIK,
            $dies->resident->name,
            $dies->resident->gender,
            $dies->resident->place_birth,
            $dies->resident->birth,
            $dies->resident->job,
            $dies->resident->religion,
            $dies->resident->kewarganegaraan,
            $dies->date,
            $dies->time,
            $dies->age,
            $dies->place,
            $dies->penyebab,
        ];
    }

    public function headings() : array
    {
        return [
            '#',
            'NIK',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Pekerjaan',
            'Agama',
            'Kewarganegaraan',
            'Tanggal Wafat',
            'Waktu',
            'Umur',
            'Tempat',
            'Penyebab',
        ];
    }
}
