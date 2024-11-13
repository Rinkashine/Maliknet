<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Spatie\Permission\Models\Role;

class RoleExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Role::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Guard Name',
            'Created_at',
            'Updated_at',
        ];
    }
}
