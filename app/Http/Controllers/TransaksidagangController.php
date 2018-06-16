<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datajenisbarang;

class TransaksidagangController extends Controller
{
    public function getTransaksiDagang()
    {
      return view('web.transaksidagang');
    }

    public function dataBarang()
    {
      $barang = Datajenisbarang::select('namabarang')->get();
      foreach ($barang as $value) {
      $null= null;
      $databarang[] = [$value->namabarang=>$null];
    }
      return response()->json($databarang);
      //dd($result);
    }
}
