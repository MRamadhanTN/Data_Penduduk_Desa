<?php

namespace App\Exports\Family;

use App\Models\Family;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FamilyTemplateExport implements WithHeadings,WithColumnWidths
{
    public function columnWidths(): array
    {
        return [
            'A' => 4,
            'B' => 20,
            'C' => 20,
            'D' => 20,
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
