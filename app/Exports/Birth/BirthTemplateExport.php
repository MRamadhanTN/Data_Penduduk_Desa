<?php

namespace App\Exports\Birth;

use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BirthTemplateExport implements WithHeadings,WithColumnWidths
{
    public function columnWidths(): array
    {
        return [
            'A' => 4,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
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
