<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Addremarks;
use App\Models\Import;

class UpdateUpdStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ImportData = DB::table('imports')->select('*')->where('created_at', Import::max('created_at'))
        ->orderBy('storecode', 'asc')
        ->get();

        return view('admin.updlist')
        ->with('ImportData', $ImportData);
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
        $Addremarks = new Addremarks;

        $Addremarks->storecode = $request->input('storecode');
        $Addremarks->date = $request->input('date');
        $Addremarks->remarks = $request->input('remarks');

        $Addremarks->save();

        return redirect('/reports')->with('status', 'Successfully Added!');
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
        $ImportData = Import::findOrfail($id);
        return view('admin.updateupdstatus.editupd')
        ->with('ImportData', $ImportData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $Addremarks = Addremarks::find($id);
        $Addremarks->remarks = $request->input('remarks');
        $Addremarks->update();
        return redirect('/reports')->with('status','Successfully Updated!');
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
}
