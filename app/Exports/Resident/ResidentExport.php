<?php

namespace App\Exports\Resident;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResidentExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Resident::get();
    }

    public function map($resident) : array {
        return [
            $resident->id,
            $resident->NIK,
            $resident->name,
            $resident->place_birth,
            $resident->birth,
            $resident->job,
            $resident->gender,
            $resident->RT,
            $resident->RW,
            $resident->address,
            $resident->provinces,
            $resident->regencies,
            $resident->districts,
            $resident->villages,
            $resident->religion,
            $resident->status,
            $resident->education,
            $resident->blood_group,
            $resident->kewarganegaraan,
            $resident->category,
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
