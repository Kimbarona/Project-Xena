<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Import;
use App\Models\Addremarks;

class ReportsController extends Controller
{
    public function index()
    {


        $entries = [];
        $entry = [];
        $countEmptydate = [];


        $upddata = DB::table('imports')
        ->leftJoin('store_list', 'imports.storecode', '=', 'store_list.Scode')
        ->select('imports.storecode', 'store_list.StoreName',
         'store_list.Dorm', 'store_list.Area','imports.created_at')
        ->groupBy('store_list.Scode')
        ->orderBy('storecode', 'asc')
        ->get();

        $History = DB::table('areas')
        ->select('*')
        ->orderBy('Area', 'asc')
        ->get();

        // select min date and max;

        $Min = DB::table('imports')->select('date')->where('date', Import::min('date'))
        ->groupBy('date')
        ->get();

        $Max = DB::table('imports')->select('date')->where('date', Import::max('date'))
        ->groupBy('date')
        ->get();

        // dd($Max);


        $DateHeader = DB::table('imports')->select('*')
        ->where('date', '!=', "")
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();


        $dt = count($DateHeader);
        $arr_date = [];

        for ($d=0; $d < $dt; $d++) {
           $arr_date[] = $DateHeader[$d]->date;
        }
        $regdates = $arr_date;

        // this is for count of missing dpd
        $Dpd = DB::table('addremarks')->select('remarks')
        ->where(function ($query) use ($regdates){
        $query->whereIn('date', $regdates);
        })->where('remarks','=','Unprocess-date')->get();

       // this is for count of missing loading
       $Loading = DB::table('addremarks')->select('remarks')
       ->where(function ($query) use ($regdates){
       $query->whereIn('date', $regdates);
       })->where('remarks','=','Loading')->get();

       // this is for count of missing regenerate
       $Regenerate = DB::table('addremarks')->select('remarks')
       ->where(function ($query) use ($regdates){
       $query->whereIn('date', $regdates);
       })->where('remarks','=','Regenerate')->get();

       // this is for count of missing Recast
       $Recast = DB::table('addremarks')->select('remarks')
       ->where(function ($query) use ($regdates){
       $query->whereIn('date', $regdates);
       })->where('remarks','=','Un-Zreading')->get();

       // this is for count of missing Recast
       $NoSales = DB::table('addremarks')->select('remarks')
       ->where(function ($query) use ($regdates){
       $query->whereIn('date', $regdates);
       })->where('remarks','=','Manual')->get();

        // this is for count of stroreclosed
        $Storeclosed = DB::table('addremarks')->select('remarks')
        ->where(function ($query) use ($regdates){
        $query->whereIn('date', $regdates);
        })->where('remarks','=','Store-closed')->get();

        foreach ($upddata as $k =>$value)
            {

                for ($i=0; $i < $dt; $i++)
                    {

                        $ress_date = $regdates[$i];
                        $entryCode = $upddata[$k]->storecode;

                            $Rowdate = DB::table('imports')->select('*')
                            ->where(function ($query) use ($entryCode, $ress_date){
                            $query->where('storecode','=',$entryCode);
                            $query->where('date','=',$ress_date);
                            })->orderBy('date', 'asc')->get();

                            if ($Rowdate->isEmpty()) {
                                $entry[$ress_date]['storecode'] = $entryCode;
                                $entry[$ress_date]['status'] = 'missing';

                                $FindRemarks = DB::table('addremarks')->select('*')
                                ->where(function ($query) use ($entryCode, $ress_date){
                                $query->where('storecode','=',$entryCode);
                                $query->where('date','=',$ress_date);
                                }) ->orderBy('date', 'asc') ->get();




                                //this is for the remarks of missing
                                $x[]= $FindRemarks;
                                foreach($FindRemarks as $fr){
                                    $fremarks = $fr->remarks;
                                    $id = $fr->id;
                                }

                                    if ($FindRemarks->isEmpty()) {
                                        $entry[$ress_date]['remarks'] = "";
                                        $entry[$ress_date]['id'] = "";
                                    }else{

                                        $entry[$ress_date]['remarks'] = $fremarks;
                                        $entry[$ress_date]['id'] = $id;

                                    }

                                    // this is for count of missing upd
                                    $countEmptydate[]= $Rowdate->isEmpty();

                            } else {
                                $entry[$ress_date]['storecode'] = $entryCode;
                                $entry[$ress_date]['status'] = 'available';
                                $entry[$ress_date]['remarks'] = "";
                                $entry[$ress_date]['id'] = "";

                            }
                    }

                $entries[] = $entry;


            }

            // dd($entries);

        return view('admin.reports.reports')
        ->with('stores', $upddata)
        ->with('History', $History)
        ->with('entries', $entries)
        ->with('regdates', $regdates)
        ->with('countEmptydate', $countEmptydate)
        ->with('Totdpd', $Dpd)
        ->with('TotLoading', $Loading)
        ->with('TotRegenerate', $Regenerate)
        ->with('TotRecast', $Recast)
        ->with('TotNoSales', $NoSales)
        ->with('Min', $Min )
        ->with('Max', $Max)
        ->with('TotNoStoreclosed', $Storeclosed)
       ;

    }

    public function OtherUser(){
        $entries = [];
        $entry = [];
        $countEmptydate = [];


        $upddata = DB::table('imports')
        ->leftJoin('store_list', 'imports.storecode', '=', 'store_list.Scode')
        ->select('imports.storecode', 'store_list.StoreName',
         'store_list.Dorm', 'store_list.Area','imports.created_at')
        ->groupBy('store_list.Scode')
        ->orderBy('storecode', 'asc')
        ->get();

        $History = DB::table('store_list')
        ->select('Area','Scode')
        ->groupBy('Area')
        ->orderBy('Area', 'asc')
        ->get();

        // select min date and max;

        $Min = DB::table('imports')->select('date')->where('date', Import::min('date'))
        ->groupBy('date')
        ->get();

        $Max = DB::table('imports')->select('date')->where('date', Import::max('date'))
        ->groupBy('date')
        ->get();

        // dd($Max);


        $DateHeader = DB::table('imports')->select('*')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        $dt = count($DateHeader);
        $arr_date = [];

        for ($d=0; $d < $dt; $d++) {
           $arr_date[] = $DateHeader[$d]->date;
        }
        $regdates = $arr_date;

         // this is for count of missing dpd
         $Dpd = DB::table('addremarks')->select('remarks')
         ->where(function ($query) use ($regdates){
         $query->whereIn('date', $regdates);
         })->where('remarks','=','Unprocess-date')->get();

        // this is for count of missing loading
        $Loading = DB::table('addremarks')->select('remarks')
        ->where(function ($query) use ($regdates){
        $query->whereIn('date', $regdates);
        })->where('remarks','=','Loading')->get();

        // this is for count of missing regenerate
        $Regenerate = DB::table('addremarks')->select('remarks')
        ->where(function ($query) use ($regdates){
        $query->whereIn('date', $regdates);
        })->where('remarks','=','Regenerate')->get();

        // this is for count of missing Recast
        $Recast = DB::table('addremarks')->select('remarks')
        ->where(function ($query) use ($regdates){
        $query->whereIn('date', $regdates);
        })->where('remarks','=','Un-Zreading')->get();

        // this is for count of missing Recast
        $NoSales = DB::table('addremarks')->select('remarks')
        ->where(function ($query) use ($regdates){
        $query->whereIn('date', $regdates);
        })->where('remarks','=','Manual')->get();

        // this is for count of stroreclosed
        $Storeclosed = DB::table('addremarks')->select('remarks')
        ->where(function ($query) use ($regdates){
        $query->whereIn('date', $regdates);
        })->where('remarks','=','Store-closed')->get();


        foreach ($upddata as $k =>$value)
            {

                for ($i=0; $i < $dt; $i++)
                    {

                        $ress_date = $regdates[$i];
                        $entryCode = $upddata[$k]->storecode;

                        // $ress_date = '01/01/2020';
                        // $entryCode = 555;
                        // ->where('created_at', Import::max('created_at'))

                            $Rowdate = DB::table('imports')->select('*')
                            ->where(function ($query) use ($entryCode, $ress_date){
                            $query->where('storecode','=',$entryCode);
                            $query->where('date','=',$ress_date);
                            })->orderBy('date', 'asc')->get();

                            if ($Rowdate->isEmpty()) {
                                $entry[$ress_date]['storecode'] = $entryCode;
                                $entry[$ress_date]['status'] = 'missing';

                                $FindRemarks = DB::table('addremarks')->select('*')
                                ->where(function ($query) use ($entryCode, $ress_date){
                                $query->where('storecode','=',$entryCode);
                                $query->where('date','=',$ress_date);
                                }) ->orderBy('date', 'asc') ->get();


                                //this is for the remarks of missing
                                $x[]= $FindRemarks;
                                foreach($FindRemarks as $fr){
                                    $fremarks = $fr->remarks;
                                    $id = $fr->id;
                                }


                                    if ($FindRemarks->isEmpty()) {
                                        $entry[$ress_date]['remarks'] = "";
                                        $entry[$ress_date]['id'] = "";
                                    }else{
                                        $entry[$ress_date]['remarks'] = $fremarks;
                                        $entry[$ress_date]['id'] = $id;

                                    }

                                    // this is for count of missing upd
                                    $countEmptydate[]= $Rowdate->isEmpty();




                            } else {
                                $entry[$ress_date]['storecode'] = $entryCode;
                                $entry[$ress_date]['status'] = 'available';
                                $entry[$ress_date]['remarks'] = "";
                                $entry[$ress_date]['id'] = "";

                            }

                    }

                $entries[] = $entry;

                    // $countEmptydate[] = $CED;

            }

// dd($entries);
    // return response()->json(["Result" => $output], 200);

        return view('admin.reports.userreports')
        ->with('stores', $upddata)
        ->with('History', $History)
        ->with('entries', $entries)
        ->with('regdates', $regdates)
        ->with('countEmptydate', $countEmptydate)
        ->with('Totdpd', $Dpd)
        ->with('TotLoading', $Loading)
        ->with('TotRegenerate', $Regenerate)
        ->with('TotRecast', $Recast)
        ->with('TotNoSales', $NoSales)
        ->with('Min', $Min )
        ->with('Max', $Max)
        ->with('TotNoStoreclosed', $Storeclosed)
       ;



    }
}
