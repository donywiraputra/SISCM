<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\User;

class RegisterController extends Controller
{
    public function getRegister()
    {
      return view('register/formRegister');
    }

    public function postRegister(Request $request)
    {
      $roleId = DB::table('roles')->where('namarole', 'user')->first();
      $datauser = new User();
      $datauser->namauser = $request->nama;
      $datauser->namalengkap = $request->namalengkap;
      $datauser->password =  bcrypt($request->password);
      $datauser->roles_id = $roleId->id;
      //dd($datauser);
      $datauser->save();

    }
}
