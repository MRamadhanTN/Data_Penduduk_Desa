<?php

namespace App\Exports\Job;

use App\Models\Job;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class JobExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Job::get();
    }

    public function map($job) : array {
        return [
            $job->id,
            $job->name,
        ];
    }

    public function headings() : array
    {
        return [
            '#',
            'Pekerjaan',
        ];
    }
}
