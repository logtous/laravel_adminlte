<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    public function data()
    {
        return view('adminlte.pages.tables.data');
    }
    public function jsgrid()
    {
        return view('adminlte.pages.tables.jsgrid');
    }
    public function simple()
    {
        return view('adminlte.pages.tables.simple');
    }
}
