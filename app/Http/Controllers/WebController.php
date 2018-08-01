<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Auth\Middleware\Authenticate;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\Datajenisbarang;

class WebController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
      $now = Carbon::now();
      $now2 = Carbon::now();
      $fivedays = $now2->addDay(5);
      $expdate = Member::join('jeniskelamin', 'member.jnskelamin', '=', 'jeniskelamin.idkelamin')
      ->join('katagorimember', 'member.id_katmember', '=', 'katagorimember.idkatmember')
      ->select('member.*', 'jeniskelamin.kelamin', 'katagorimember.katmember')
      ->whereBetween('expired_date', [$now, $fivedays] )
      ->orWhere('expired_date', '<', $now)
      ->get();

      $stokbarang = Datajenisbarang::where('stok', '<=', 3)->get();

      return view('web/home', compact('expdate', 'stokbarang'));
    }

}
