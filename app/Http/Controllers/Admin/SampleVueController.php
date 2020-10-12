<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SampleVueController extends Controller
{
    public function index(){

        return view('admin.SampleVue');
    }
}
