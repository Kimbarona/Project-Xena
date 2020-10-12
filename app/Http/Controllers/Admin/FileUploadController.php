<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Import;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Imports\PostImport;

class FileUploadController extends Controller
{
    public function index()
    {
        $imports = Import::all();
        // ->where('created_at', Import::max('created_at'));
        return view('admin.fileupload.fileuploadindex',compact('imports'));
    }

    public function ImportPost(Request $request)
    {
        $request->validate([
            'file'  => 'required|mimes:csv,txt'
           ]);

           $file = file($request->file('file')->getRealPath());
           $data = array_slice($file, 1);

           $parts = (array_chunk($data, 50000));

           foreach($parts as $index=>$part){

                $filename = resource_path('pending-files/'.date('y-m-d-H-i-s').$index. '.csv');

                file_put_contents($filename, $part);

                DB::table('imports')->truncate();

                (new Import())->ImportToDb();
                return back()->with('success', 'Excel Data Imported successfully.');

           }

        // dd($file)->all();

    }

}
