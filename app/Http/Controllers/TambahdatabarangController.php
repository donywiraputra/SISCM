<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datajenisbarang;
use Illuminate\Support\Facades\Auth;

class TambahdatabarangController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getTambahDataBarang()
    {
      return view('web.tambahdatabarang');
    }

    public function insertDataBarang(Request $request)
    {
      $databarang = new Datajenisbarang;
      $databarang->namabarang = $request->namabarang;
      $databarang->harga = $request->harga;
      $databarang->stok = $request->stok;
      $databarang->namabarang = $request->namabarang;
      $userid = Auth::user();
      $databarang->iduser = $userid->id;
      $databarang->save();

      return view('web.tambahdatabarang');
    }
}
