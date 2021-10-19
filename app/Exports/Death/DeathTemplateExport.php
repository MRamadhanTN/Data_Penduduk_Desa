<?php

namespace App\Exports\Death;

use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeathTemplateExport implements WithHeadings,WithColumnWidths
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
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
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
