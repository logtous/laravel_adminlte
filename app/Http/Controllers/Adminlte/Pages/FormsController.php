<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormsController extends Controller
{
    public function advanced()
    {
        return view('adminlte.pages.forms.advanced');
    }
    public function editors()
    {
        return view('adminlte.pages.forms.editors');
    }
    public function general()
    {
        return view('adminlte.pages.forms.general');
    }
    public function validation()
    {
        return view('adminlte.pages.forms.validation');
    }
}
