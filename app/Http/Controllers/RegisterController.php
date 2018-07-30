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
      $this->validate($request,
      [
        'nama'=> 'required',
        'namalengkap'=> 'required',
        'userlevel'=> 'required',
        'password'=> 'required|min:5',
        'repassword'=> 'required|same:password'
      ],
      [
        'nama.required'=> 'Nama user harus diisi',
        'namalengkap.required'=> 'Nama lengkap harus diisi',
        'userlevel.required'=> 'Pilih level user',
        'password.required'=> 'password harus diisi',
        'password.min'=> 'Password minimal 5 karakter',
        'repassword.required'=> 'ketikkan ulang password',
        'repassword.same'=> 'password ulang harus sama'
      ]);
      // $roleId = DB::table('roles')->where('namarole', 'user')->first();
      $datauser = new User();
      $datauser->namauser = $request->nama;
      $datauser->namalengkap = $request->namalengkap;
      $datauser->password =  bcrypt($request->password);
      $datauser->roles_id = $request->userlevel;
      $datauser->save();

      return redirect('register')->with(['success' => 'Data berhasil disimpan']);
    }
}
