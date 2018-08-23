<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;
use App\Models\Jnstransaksi;
use App\Models\Datatransaksi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function getTransaksi()
  {
    $fitness = Jnstransaksi::where('namatransaksi', 'LIKE', '%fitness%')->get();
    $aerobic = Jnstransaksi::where('namatransaksi', 'LIKE', '%aerobic%')->get();
    $yoga = Jnstransaksi::where('namatransaksi', 'LIKE', '%yoga%')->get();

    return view('web/transaksimember', compact('fitness', 'aerobic', 'yoga'));
  }

  public function dataMember(Request $request)
  {
    $member = DB::table('member')->select('namamember')->get();
    foreach ($member as $value) {
    $null= null;
    $datamember[] = [$value->namamember=>$null];
  }
    return response()->json($datamember);
    //dd($result);
  }

  public function showDataMember(Request $request)
  {
    $a = $request->input;
    $memberdata = Member::join('jeniskelamin', 'member.jnskelamin', '=', 'jeniskelamin.idkelamin')
    ->join('katagorimember', 'member.id_katmember', '=', 'katagorimember.idkatmember')
    ->select('member.*', 'jeniskelamin.kelamin', 'katagorimember.katmember')
    ->where('member.namamember', '=', $a)->first();
    return response()->json($memberdata);
  }

  public function biayaTransaksi(Request $request)
  {
    $pilihbiaya = $request->biaya;
    $postbiaya = Jnstransaksi::where('idjnstransaksi', '=', $pilihbiaya)->first();
    $jmlh = $postbiaya->biaya;

    return response()->json($jmlh);

  }

  public function postTrans(Request $request)
  {
    $datatrans = new Datatransaksi();
    $nama = $request->namambr;
    $gettrans = $request->jtrans;
    $trans = Jnstransaksi::where('idjnstransaksi', $gettrans)->first();
    $idmbr = Member::where('namamember', $nama)->first();
    $datatrans->id_member = $idmbr->idmember;
    $datatrans->idjenistransaksi = $request->jtrans;
    $datatrans->biaya = $trans->biaya;
    $userid = Auth::user();
    $datatrans->iduser = $userid->id;
    $datatrans->save();


    $month = $trans->bulan;
    $null = null;
    if($month == null){
      $member = Member::where('namamember', $nama)->first();
      $member->expired_date = $null;
      $member->save();

      return redirect('transmember')->with(['success' => 'Transaksi berhasil diproses']);
    }else{
    $now = Carbon::now();
    $nextMonth = $now->addMonths($month);
    $member = Member::where('namamember', $nama)->first();
    $member->expired_date = $nextMonth->format('Y-m-d');

    $member->save();
    }

    return redirect('transmember')->with(['success' => 'Transaksi berhasil diproses']);

  }

}
