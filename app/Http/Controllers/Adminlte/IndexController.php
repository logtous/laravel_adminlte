<?php

namespace App\Http\Controllers\Adminlte;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('adminlte.index');
    }
    
    public function index2()
    {
        return view('adminlte.index2');
    }

    public function index3()
    {
        return view('adminlte.index3');
    }

    public function starter()
    {
        return view('adminlte.starter');
    }
}
