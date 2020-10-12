<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Import;

use App\Exports\UpdExport;
use App\Exports\UpdExportView;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

$entries = [];
$entry = [];

        $upddata = DB::table('imports')
        ->leftJoin('store_list', 'imports.storecode', '=', 'store_list.Scode')
        ->select('imports.storecode', 'store_list.StoreName',
         'store_list.Dorm', 'store_list.Area')
        ->groupBy('store_list.Scode')
        ->orderBy('storecode', 'asc')
        ->get();

        $DateHeader = DB::table('imports')->select('*')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        $FindData = DB::table('imports')->select('remarks')->where('created_at', Import::max('created_at'))
        ->where('remarks','!=','')
        ->orderBy('storecode', 'asc')
        ->get();


        // Dateheader
        $dt = count($DateHeader);
        $arr_date = [];

        for ($d=0; $d < $dt; $d++) {
           $arr_date[] = $DateHeader[$d]->date;
        }
        $regdates = $arr_date;

        // Findata
        $fd = count($FindData);
        $arr_id = [];

        for ($x=0; $x < $fd; $x++) {
            // $arr_id[] = $FindData[$x]->id;
            $remarks[] = $FindData[$x]->remarks;
         }
        //  $find_id = $arr_id;
        //  $find_remarks = $remarks;

        foreach ($upddata as $k =>$value)
            {

                for ($i=0; $i < $dt; $i++)
                    {

                        $ress_date = $regdates[$i];
                        $entryCode = $upddata[$k]->storecode;

                        // $rem = $remarks[$i];
                        // $ress_date = '01/01/2020';
                        // $entryCode = 555;

                            $Rowdate = DB::table('imports')->select('*')->where('created_at', Import::max('created_at'))
                            ->where(function ($query) use ($entryCode, $ress_date){
                            $query->where('storecode','=',$entryCode);
                            $query->where('date','=',$ress_date);
                            })->get();

                            if ($Rowdate->isEmpty()) {
                                // $entry[$ress_date]['remarks'] = $rem;
                                $entry[$ress_date]['storecode'] = $entryCode;
                                $entry[$ress_date]['status'] = 'missing';

                                // $FindData = DB::table('imports')->select('remarks')->where('created_at', Import::max('created_at'))
                                // ->where('remarks','=','Dpd')
                                // ->orderBy('storecode', 'asc')
                                // ->get();

                                //     if($FindData== 'Dpd'){
                                //         $entry[$ress_date]['remarks'] = 'dpd';

                                //     }else{
                                //         $entry[$ress_date]['remarks'] = 'dpd';
                                //     }

                            }else {
                                // $entry[$ress_date]['remarks'] = $rem;
                                $entry[$ress_date]['storecode'] = $entryCode;
                                $entry[$ress_date]['status'] = 'available';
                                // $entry[$ress_date]['remarks'] = 'missing';
                                // $FindData = DB::table('imports')->select('remarks')->where('created_at', Import::max('created_at'))
                                // ->where('remarks','!=','')
                                // ->orderBy('storecode', 'asc')
                                // ->get();

                                //     if($FindData->isEmpty()){
                                //         $entry[$ress_date]['remarks'] = 'missing';

                                //     }else{
                                //         $entry[$ress_date]['remarks'] = 'available';
                                //     }


                            }
                    }

                $entries[] = $entry;


            }
            // dd($entries);


    // return response()->json(["Result" => $output], 200);

        return view('admin.dashboard')
        ->with('stores', $upddata)
        ->with('entries', $entries)
        ->with('regdates', $regdates)

        ;


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function export()
    {
        return Excel::download(new UpdExport(), 'exportedfile.xlsx');
    }
}
