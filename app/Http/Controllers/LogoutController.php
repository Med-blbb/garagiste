<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class LogoutController extends Controller
{
    public function perform(){
        FacadesSession::flush();
        Auth::logout();
        return redirect('/login');
    }
}
