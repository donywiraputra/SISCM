<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;


class LoginController extends Controller
{
  public function getLogin()
  {
    return view('register/formLogin');
  }

  public function postLogin(Request $request)
  {
    if (Auth::attempt([
      'namauser' => $request->nama,
      'password' => $request->password]))
    {


      return redirect('/');
    }else{
      return redirect('login')->with(['error' => 'Nama user dengan password tidak cocok.']);
    }
  }
}
