<?php

namespace App\Exports\Come;

use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ComeTemplateExport implements WithHeadings,WithColumnWidths
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
            'H' => 10,
            'I' => 10,
            'J' => 40,
            'K' => 20,
            'L' => 20,
            'M' => 20,
            'N' => 20,
            'O' => 20,
            'P' => 20,
            'Q' => 20,
            'R' => 20,
            'S' => 20,
            'T' => 20,
        ];
    }

    public function headings() : array
    {
        return [
            '#',
            'NIK',
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Pekerjaan',
            'Jenis Kelamin',
            'RT',
            'RW',
            'Alamat',
            'Provinsi',
            'Kabupaten',
            'Kecamatan',
            'Kelurahan',
            'Agama',
            'Status',
            'Pendidikan',
            'Golongan Darah',
            'Kewarganegaraan',
            'Kategori',
        ];
    }
}
