<?php

namespace App\Http\Controllers\apiv1\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;
use App\Models\Import;

use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function customer(){
        return response()->json(customer::get(), 200);
    }

    public function findcustomer($id){
        $customer = Customer::find($id);

        // to check if it is null
        if(is_null($customer))
            {
                return response()->json(['message'=>'Record Not Found!'], 404);
            }

        return response()->json($customer, 200);
    }

    public function Savecustomer(Request $request){
        $rules = [
            'name' => 'required|min:3',
            'phone' => 'required|max:13'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        customer::create($request->all());
        return response()->json(['message'=>'Successfully Added!'], 201);
    }

    public function Updatecustomer(Request $request, $customerId){

        $customer = Customer::find($customerId);

        if(is_null($customer))
            {
                return response()->json(['message'=>'Record Not Found!'], 404);
            }
        $customer->update($request->all());
        return response()->json(['message'=>'Updated Successfully'], 200);
    }

    public function Deletecustomer(Request $request, Customer $customerId){
        $customerId->delete();
        return response()->json(['message'=>'Successfully Deleted!'], 204);
    }

    public function showdata(){

        // Header date
        $Headerdate = DB::table('imports')->select('date')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();
        $Header= json_decode( json_encode($Headerdate), true);

        // select all
        $upddata = DB::table('store_list')
        ->leftJoin('imports', 'store_list.Scode', '=', 'imports.storecode')
        ->select('imports.storecode', 'store_list.StoreName', 'store_list.Dorm', 'store_list.Area', 'imports.date')
        // ->where('imports.created_at', Import::max('imports.created_at'))
        ->groupBy('store_list.Scode')
        ->orderBy('storecode', 'asc')
        ->get();

        // get the date

         // New Code trial
        foreach ( $upddata as $upddatas){
            $FinalData = [
                "storecode" => $upddatas->storecode,
                "StoreName" => $upddatas->StoreName,
                "Dorm" => $upddatas->Dorm,
                "Area" => $upddatas->Area,
                $entryCode = $upddatas->storecode,
            ];
                // $Code[] = $entryCode;

                //  row date
                $Rowdate = DB::table('imports')->select('date')->where('created_at', Import::max('created_at'))
                ->where(function ($code) use ($entryCode){
                $code->where('storecode','=',$entryCode);
                })->get();


                foreach ($Rowdate as $dates) {
                            $FinalData['dates'][]= $dates->date;
                        }
                        $output[] = $FinalData;

        }


        return response()->json(['Result'=>$output], 200);

    }
}

