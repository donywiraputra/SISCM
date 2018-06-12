<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Jkelamin;
use App\Models\Katagorimember;
use App\Models\Datatransaksi;
use Carbon\Carbon;

class DataMemberController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function getdatamember()
  {
    $memberview = Member::join('jeniskelamin', 'member.jnskelamin', '=', 'jeniskelamin.idkelamin')
    ->join('katagorimember', 'member.id_katmember', '=', 'katagorimember.idkatmember')
    ->select('member.*', 'jeniskelamin.kelamin', 'katagorimember.katmember')
    ->orderBy('member.updated_at','desc')
    ->paginate(8);
    //dd($memberview);
    return view('web/datamember', compact('memberview'));
  }

  public function tabelmember(Request $request)
  {
    $tes = $request->insert;
    if($tes == 'harian'){
    $memberview = Member::join('jeniskelamin', 'member.jnskelamin', '=', 'jeniskelamin.idkelamin')
    ->join('katagorimember', 'member.id_katmember', '=', 'katagorimember.idkatmember')
    ->select('member.*', 'jeniskelamin.kelamin', 'katagorimember.katmember')
    ->where('member.expired_date', '=', null)
    ->orderBy('member.updated_at','desc')
    ->paginate(8);
  //  dd($memberview);
      return view('layouts.tabelmember',compact('memberview'));
  }else if($tes == 'exp'){
    $now = Carbon::now();
    $now2 = Carbon::now();
    $fivedays = $now2->addDay(5);
    $memberview = Member::join('jeniskelamin', 'member.jnskelamin', '=', 'jeniskelamin.idkelamin')
    ->join('katagorimember', 'member.id_katmember', '=', 'katagorimember.idkatmember')
    ->select('member.*', 'jeniskelamin.kelamin', 'katagorimember.katmember')
    ->whereBetween('expired_date', [$now, $fivedays] )
    ->orWhere('expired_date', '<', $now)
    ->orderBy('member.updated_at','desc')
    ->paginate(8);

    return view('layouts.tabelmember',compact('memberview'));
  }else if(!empty($tes)){
    $memberview = Member::join('jeniskelamin', 'member.jnskelamin', '=', 'jeniskelamin.idkelamin')
    ->join('katagorimember', 'member.id_katmember', '=', 'katagorimember.idkatmember')
    ->select('member.*', 'jeniskelamin.kelamin', 'katagorimember.katmember')
    ->where('member.namamember', 'LIKE', '%'.$tes.'%')
    ->orWhere('member.namalengkap', 'LIKE', '%'.$tes.'%')
    ->orWhere('katagorimember.katmember', 'LIKE', '%'.$tes.'%')
    ->orWhere('member.created_at', 'LIKE', '%'.$tes.'%')
    ->orWhere('member.expired_date', 'LIKE', '%'.$tes.'%')
    ->orderBy('member.updated_at','desc')
    ->paginate(8);
    //  dd($transview);
    return view('layouts.tabelmember',compact('memberview'));
  }
    $memberview = Member::join('jeniskelamin', 'member.jnskelamin', '=', 'jeniskelamin.idkelamin')
    ->join('katagorimember', 'member.id_katmember', '=', 'katagorimember.idkatmember')
    ->select('member.*', 'jeniskelamin.kelamin', 'katagorimember.katmember')
    ->orderBy('member.updated_at','desc')
    ->paginate(8);
    //dd($memberview);
    return view('layouts.tabelmember', compact('memberview'));
    //dd($transview);
  }

  public function detailmember($id)
  {
    $katagori = Katagorimember::all();
    $kelamins = Jkelamin::all();
    $memberview = Member::join('jeniskelamin', 'member.jnskelamin', '=', 'jeniskelamin.idkelamin')
    ->join('katagorimember', 'member.id_katmember', '=', 'katagorimember.idkatmember')
    ->select('member.*', 'jeniskelamin.kelamin', 'katagorimember.katmember')->find($id);
    //dd($memberview);

    return view('web/editmember', compact('memberview', 'katagori', 'kelamins'));
  }

  public function updatemember(Request $request, $id)
  {
    $this->validate($request,
    [
      'namambredit'=> 'required',
      'namalengkap'=> 'required',
      'jeniskelamin'=> 'required',
      'alamat'=> 'required',
      'tgllahir'=> 'required',
      'notelp'=> 'required'
    ]);
    $updatembr = Member::where('idmember', $id)->first();
    $updatembr->namamember = $request->namambredit;
    $updatembr->namalengkap = $request->namalengkap;
    $updatembr->jnskelamin = $request->jeniskelamin;
    $updatembr->alamat = $request->alamat;
    $updatembr->tgl_lahir = $request->tgllahir;
    $updatembr->notelp = $request->notelp;
    $updatembr->save();

    return redirect('datamember')->with(['success' => 'Data member berhasil diedit']);
  }

  public function deletemember($id)
  {
    $deletetrans = Member::find($id);
    $deletetrans->delete();

    return redirect('datamember')->with(['success' => 'Data member berhasil dihapus']);
  }


}
