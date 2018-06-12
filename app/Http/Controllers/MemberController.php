<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Katagorimember;
use App\Models\Jkelamin;
use App\Models\Member;
use App\Models\Jnstransaksi;
use App\Models\Datatransaksi;

class MemberController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getMember()
    {

      $katagori = Katagorimember::all();
      $kelamins = Jkelamin::all();

      return view('web/registermember', compact('katagori', 'kelamins'));
    }

    public function validasiNama(Request $request)
    {
      $nilainama = $request->input;
      $ceknama = Member::where('namamember', '=', $nilainama)->first();
      if(empty($ceknama)){
        return 'sukses';
      }else{
        return 'gagal';
      }
    }

    public function createMember(Request $request)
    {
      $this->validate($request,
      [
        'katagorimember'=> 'required',
        'namambr'=> 'required',
        'namalengkap'=> 'required',
        'jeniskelamin'=> 'required',
        'alamat'=> 'required',
        'tgllahir'=> 'required',
        'notelp'=> 'required'
      ]);
      $datamember = new Member();
      $namakatagori = $request->katagorimember;
      $gantikatagori = Katagorimember::where('idkatmember', $namakatagori)->first();
      $datamember->id_katmember = $gantikatagori->idkatmember;
      $datamember->namamember = $request->namambr;
      $datamember->namalengkap = $request->namalengkap;
      $ubhjnskelamin = $request->jeniskelamin;
      $namajnskelamin = Jkelamin::where('idkelamin', $ubhjnskelamin)->first();
      $datamember->jnskelamin = $namajnskelamin->idkelamin;
      $datamember->alamat = $request->alamat;
      $datamember->tgl_lahir = $request->tgllahir;
      $datamember->notelp = $request->notelp;
      $datamember->save();

      return redirect('regmember')->with(['success' => 'Data berhasil disimpan']);
    }




}
