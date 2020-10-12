<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Import;

// add this to use model
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {

        $customer = Customer::all();
        return view('admin.customer')
        ->with('customer', $customer);


    }

    public function store( Request $request)
    {
        $customer = new Customer;

        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->phone = $request->input('phone');

        $customer->save();

        return redirect('/customer')->with('status', 'Customer Successfully Added!');
    }

    public function edit($id)
    {
        $customer = Customer::findOrfail($id);
        return view('admin.customer.edit')
        ->with('customer', $customer);

    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->input('name');
        $customer->address = $request->input('address');
        $customer->phone = $request->input('phone');
        $customer->update();
        return redirect('/customer')->with('status','Successfully Updated!');
    }

    public function delete($id)
    {
        $customer = Customer::findOrfail($id);
        $customer->delete();

        return redirect('/customer')->with('status','Successfully Deleted!');
    }
}
