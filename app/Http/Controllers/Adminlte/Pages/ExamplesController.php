<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamplesController extends Controller
{
    public function example404()
    {
        return view('adminlte.pages.examples.404');
    }

    public function example500()
    {
        return view('adminlte.pages.examples.500');
    }

    public function blank()
    {
        return view('adminlte.pages.examples.blank');
    }

    public function contacts()
    {
        return view('adminlte.pages.examples.contacts');
    }

    public function eCommerce()
    {
        return view('adminlte.pages.examples.e-commerce');
    }

    public function forgotPassword()
    {
        return view('adminlte.pages.examples.forgot-password');
    }

    public function invoicePrint()
    {
        return view('adminlte.pages.examples.invoice-print');
    }
    public function invoice()
    {
        return view('adminlte.pages.examples.invoice');
    }
    public function languageMenu()
    {
        return view('adminlte.pages.examples.language-menu');
    }
    public function legacyUserMenu()
    {
        return view('adminlte.pages.examples.legacy-user-menu');
    }
    public function lockscreen()
    {
        return view('adminlte.pages.examples.lockscreen');
    }
    public function login()
    {
        return view('adminlte.pages.examples.login');
    }
    public function pace()
    {
        return view('adminlte.pages.examples.pace');
    }
    public function profile()
    {
        return view('adminlte.pages.examples.profile');
    }
    public function projectAdd()
    {
        return view('adminlte.pages.examples.project-add');
    }
    public function projectDetail()
    {
        return view('adminlte.pages.examples.project-detail');
    }
    public function projectEdit()
    {
        return view('adminlte.pages.examples.project-edit');
    }
    public function projects()
    {
        return view('adminlte.pages.examples.projects');
    }
    public function recoverPassword()
    {
        return view('adminlte.pages.examples.recover-password');
    }
    public function register()
    {
        return view('adminlte.pages.examples.register');
    }
}
