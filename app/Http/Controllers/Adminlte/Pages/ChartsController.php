<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartsController extends Controller
{
    public function chartjs()
    {
        return view('adminlte.pages.charts.chartjs');
    }

    public function flot()
    {
        return view('adminlte.pages.charts.flot');
    }

    public function inline()
    {
        return view('adminlte.pages.charts.inline');
    }
}
