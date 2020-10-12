<?php

namespace App\Exports;

use App\Models\Import;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UpdExportView implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $upddata;

    public function __construct($upddata)
    {
        $this->data = $upddata;
    }
    public function view(): View
    {
        // return Import::all();
        return view('admin.dashboard', [
            'data' => $this->data
        ]);
    }
}
