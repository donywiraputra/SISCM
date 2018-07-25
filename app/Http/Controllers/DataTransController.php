<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Datatransaksi;
use App\Models\Member;
use App\Models\Jnstransaksi;


class DataTransController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function getDataTrans()
  {
    $transview = Datatransaksi::join('jenistransaksi', 'datatransaksi.idjenistransaksi', '=', 'jenistransaksi.idjnstransaksi')
    ->join('member', 'datatransaksi.id_member', '=', 'member.idmember')
    ->join('users', 'datatransaksi.iduser', '=', 'users.id')
    ->select('datatransaksi.*', 'jenistransaksi.namatransaksi', 'member.namamember', 'users.namauser')
    ->orderBy('datatransaksi.updated_at','desc')
    ->paginate(8);
     //dd($transview);
    return view('web/datatrans',compact('transview'));
  }

  public function tabelTrans(Request $request)
  {
    $tes = $request->insert;
    if(!empty($tes))
    {
    $transview = Datatransaksi::join('jenistransaksi', 'datatransaksi.idjenistransaksi', '=', 'jenistransaksi.idjnstransaksi')
    ->join('member', 'datatransaksi.id_member', '=', 'member.idmember')
    ->join('users', 'datatransaksi.iduser', '=', 'users.id')
    ->select('datatransaksi.*', 'jenistransaksi.namatransaksi', 'member.namamember', 'users.namauser')
    ->where('jenistransaksi.namatransaksi', 'LIKE', '%'.$tes.'%')
    ->orWhere('jenistransaksi.biaya', 'LIKE', '%'.$tes.'%')
    ->orWhere('member.namamember', 'LIKE', '%'.$tes.'%')
    ->orWhere('users.namauser', 'LIKE', '%'.$tes.'%')
    ->orWhere('datatransaksi.created_at', 'LIKE', '%'.$tes.'%')
    ->orderBy('datatransaksi.updated_at','desc')
    ->paginate(8);
    //  dd($transview);
    return view('layouts.tabeltransaksi',compact('transview'));
    }
    $transview = Datatransaksi::join('jenistransaksi', 'datatransaksi.idjenistransaksi', '=', 'jenistransaksi.idjnstransaksi')
    ->join('member', 'datatransaksi.id_member', '=', 'member.idmember')
    ->join('users', 'datatransaksi.iduser', '=', 'users.id')
    ->select('datatransaksi.*', 'jenistransaksi.namatransaksi', 'member.namamember', 'users.namauser')
    ->orderBy('datatransaksi.updated_at','desc')
    ->paginate(8);
    return view('layouts.tabeltransaksi',compact('transview'));
    //  dd($transview);
  }

  public function editTrans($id)
  {
    $trans = Datatransaksi::join('jenistransaksi', 'datatransaksi.idjenistransaksi', '=', 'jenistransaksi.idjnstransaksi')
    ->join('member', 'datatransaksi.id_member', '=', 'member.idmember')
    ->join('users', 'datatransaksi.iduser', '=', 'users.id')
    ->select('datatransaksi.*', 'jenistransaksi.namatransaksi', 'member.namamember', 'users.namauser')
    ->where('datatransaksi.idtransaksi', '=', $id)->first();
    $fitness = Jnstransaksi::where('namatransaksi', 'LIKE', '%fitness%')->get();
    $aerobic = Jnstransaksi::where('namatransaksi', 'LIKE', '%aerobic%')->get();

    return view('web/edittransaksi', compact('fitness', 'aerobic', 'trans'));
  }

  public function updateTrans(Request $request, $id)
  {
    $updatetrs = Datatransaksi::where('idtransaksi', $id)->first();
    $namainput = $request->namambr;
    $namaid = Member::where('namamember',$namainput)->first();
    $updatetrs->id_member = $namaid->idmember;
    $updatetrs->idjenistransaksi = $request->jtrans;
    $updatetrs->save();

    return redirect('datatransaksi')->with(['success' => 'Data transaksi berhasil diedit']);
  }

  public function deleteTrans($id)
  {
    $deletetrans = Datatransaksi::find($id);
    $deletetrans->delete();

    return redirect('datatransaksi');
  }
}
