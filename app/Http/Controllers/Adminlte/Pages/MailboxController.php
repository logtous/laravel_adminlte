<?php

namespace App\Http\Controllers\Adminlte\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailboxController extends Controller
{
    public function compose()
    {
        return view('adminlte.pages.mailbox.compose');
    }
    public function mailbox()
    {
        return view('adminlte.pages.mailbox.mailbox');
    }
    public function readMail()
    {
        return view('adminlte.pages.mailbox.read-mail');
    }
}
