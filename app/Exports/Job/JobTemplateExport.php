<?php

namespace App\Exports\Job;

use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobTemplateExport implements WithHeadings,WithColumnWidths
{
    public function columnWidths(): array
    {
        return [
            'A' => 4,
            'B' => 20,
        ];
    }

    public function headings() : array
    {
        return [
            '#',
            'Nama',
        ];
    }
}
