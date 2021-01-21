<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function calendar()
    {
        return view('adminlte.pages.calendar');
    }
    
    public function gallery()
    {
        return view('adminlte.pages.gallery');
    }

    public function widgets()
    {
        return view('adminlte.pages.widgets');
    }
}
