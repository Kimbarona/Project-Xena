<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Session;

// add this to use model

use App\Models\StoreList;

class ManageStoreController extends Controller
{
    public function index()
    {
        $StoreList = StoreList::all();
        // return StoreList::all();
        return view('admin.manage-store.manage_store', compact('StoreList', $StoreList));


    }

    public function store( Request $request)
    {

        //validation
        $validator = Validator::make($request->all(),
        [
            "Scode" => "required|min:2|max:5|unique:store_list",
            "StoreName" => "required|min:3|max:35|unique:store_list",
            "Dorm" => "required|min:3|max:35",
            "Area" => "required|min:1|max:200",
        ]);

        if($validator->fails()){
            // Session::flash('statuscode','warning');
            return redirect("/manage-store")->withErrors($validator)->withInput();
        }

        $StoreList = new StoreList;

        $StoreList->Scode = $request->input('Scode');
        $StoreList->StoreName = $request->input('StoreName');
        $StoreList->Dorm = $request->input('Dorm');
        $StoreList->Area = $request->input('Area');
        $StoreList->StoreStatus = $request->input('StoreStatus');

        $StoreList->save();

         //this is the method on how to use the sweetalert!
        Session::flash('statuscode','success');

        return redirect('/manage-store')->with('status', 'Store Successfully Added!');
    }

    public function edit($id)
    {
        $StoreList = StoreList::findOrfail($id);
        return view('admin.manage-store.editform')
        ->with('StoreList', $StoreList);

    }

    public function update(Request $request, $id)
    {
        $StoreList = StoreList::find($id);
        $StoreList->Scode = $request->input('Scode');
        $StoreList->StoreName = $request->input('StoreName');
        $StoreList->Dorm = $request->input('Dorm');
        $StoreList->Area = $request->input('Area');
        $StoreList->StoreStatus = $request->input('StoreStatus');

        $StoreList->update();

        //this is the method on how to use the sweetalert!
        Session::flash('statuscode','info');

        return redirect('/manage-store')->with('status','Successfully Updated!');
    }

}
