<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UIController extends Controller
{
    public function buttons()
    {
        return view('adminlte.pages.UI.buttons');
    }
    public function general()
    {
        return view('adminlte.pages.UI.general');
    }
    public function icons()
    {
        return view('adminlte.pages.UI.icons');
    }
    public function modals()
    {
        return view('adminlte.pages.UI.modals');
    }
    public function navbar()
    {
        return view('adminlte.pages.UI.navbar');
    }
    public function ribbons()
    {
        return view('adminlte.pages.UI.ribbons');
    }
    public function sliders()
    {
        return view('adminlte.pages.UI.sliders');
    }
    public function timeline()
    {
        return view('adminlte.pages.UI.timeline');
    }
}
