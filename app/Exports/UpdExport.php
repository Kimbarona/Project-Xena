<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use App\Models\Import;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UpdExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('store_list')
        ->leftJoin('imports', 'imports.storecode', '=', 'store_list.Scode')
        ->select('imports.storecode', 'store_list.StoreName',
         'store_list.Dorm', 'store_list.Area','imports.date')
        ->get();

    }
    public function headings(): array
    {
        return [
            'Store Code',
            'Store Name',
            'Dorm',
            'Area',
            'Date',
        ];
    }
}
