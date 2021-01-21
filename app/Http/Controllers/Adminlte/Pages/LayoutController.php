<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function boxed()
    {
        return view('adminlte.pages.layout.boxed');
    }
    public function collapsedSidebar()
    {
        return view('adminlte.pages.layout.collapsed-sidebar');
    }
    public function fixedFooter()
    {
        return view('adminlte.pages.layout.fixed-footer');
    }
    public function fixedSidebar()
    {
        return view('adminlte.pages.layout.fixed-sidebar');
    }
    public function fixedTopnav()
    {
        return view('adminlte.pages.layout.fixed-topnav');
    }
    public function topNavSidebar()
    {
        return view('adminlte.pages.layout.top-nav-sidebar');
    }
    public function topNav()
    {
        return view('adminlte.pages.layout.top-nav');
    }
}
