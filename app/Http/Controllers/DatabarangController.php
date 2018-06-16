<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datajenisbarang;

class DatabarangController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getDataBarang()
    {
      $databarang = Datajenisbarang::join('users', 'jenisbarang.iduser', '=', 'users.id')
      ->select('jenisbarang.*', 'users.namauser')
      ->orderBy('jenisbarang.updated_at','desc')
      ->paginate(8);
      //dd($databarang);
      return view('web.databarang', compact('databarang'));
    }

    public function tabelBarang(Request $request)
    {
      $inputcari = $request->insert;
      if(!empty($inputcari))
      {
        $databarang = Datajenisbarang::join('users', 'jenisbarang.iduser', '=', 'users.id')
        ->select('jenisbarang.*', 'users.namauser')
        ->where('jenisbarang.namabarang', 'like', '%'.$inputcari.'%')
        ->orWhere('jenisbarang.harga', 'like', '%'.$inputcari.'%')
        ->orWhere('jenisbarang.stok', 'like', '%'.$inputcari.'%')
        ->orWhere('users.namauser', 'like', '%'.$inputcari.'%')
        ->orWhere('jenisbarang.updated_at', 'like', '%'.$inputcari.'%')
        ->orderBy('jenisbarang.updated_at','desc')
        ->paginate(8);
        //dd($databarang);
        return view('layouts.tabeldatabarang', compact('databarang'));
      }
      $databarang = Datajenisbarang::join('users', 'jenisbarang.iduser', '=', 'users.id')
      ->select('jenisbarang.*', 'users.namauser')
      ->orderBy('jenisbarang.updated_at','desc')
      ->paginate(8);

      return view('layouts.tabeldatabarang', compact('databarang'));
    }

}
