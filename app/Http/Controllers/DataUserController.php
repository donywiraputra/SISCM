<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class DataUserController extends Controller
{
    public function getDataUser()
    {
      $getuser = User::join('roles', 'users.roles_id', '=', 'roles.id')
      ->select('users.*', 'roles.namarole')->get();

      return view('web.datauser', compact('getuser'));
    }

    public function getEditUser($id)
    {
      $edituser = User::join('roles', 'users.roles_id', '=', 'roles.id')
      ->select('users.*', 'roles.namarole')
      ->where('users.id', '=', $id)->first();

      return view('web.edituser', compact('edituser'));
    }

    public function getGantiPass($id)
    {
      $userpass = User::where('id', '=', $id)->first();

      return view('web.gantipassword', compact('userpass'));
    }

    public function updateUser(Request $request, $id)
    {
      $this->validate($request,
      [
        'nama'=> 'required',
        'namalengkap'=> 'required'
      ],
      [
        'nama.required'=> 'Nama user harus diisi',
        'namalengkap.required'=> 'Nama lengkap harus diisi'
      ]);
      $updateuser = User::where('id', '=', $id)->first();
      $updateuser->namauser = $request->nama;
      $updateuser->namalengkap = $request->namalengkap;
      $updateuser->save();

      return redirect('datauser')->with(['success' => 'Data berhasil disimpan']);
    }

    public function updateUserPass(Request $request, $id)
    {
      $this->validate($request,
      [
        'password'=> 'required|min:5',
        'repassword'=> 'required|same:password'
      ],
      [
        'password.required'=> 'password harus diisi',
        'password.min'=> 'Password minimal 5 karakter',
        'repassword.required'=> 'ketikkan ulang password',
        'repassword.same'=> 'password ulang harus sama'
      ]);
      $updatepass = User::where('id', '=', $id)->first();
      $updatepass->password = bcrypt($request->password);
      $updatepass->save();

      return redirect('datauser')->with(['success' => 'Password berhasil diubah']);
    }

    public function deleteUser($id)
    {
      $deleteuser = User::find($id);
      $deleteuser->delete();

      return redirect('datauser')->with(['success' => 'User berhasil dihapus']);
    }
}
