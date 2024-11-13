<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollectionm, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Role_id',
            'Phone number',
            'address',
            'password',
            'gender',
             'age',
            'Created_at',
            'Updated_at',
        ];
    }
}
