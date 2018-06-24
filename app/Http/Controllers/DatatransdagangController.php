<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datajenisbarang;
use App\Models\Transaksidagang;

class DatatransdagangController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getDataTransDagang()
    {
      $datadagang = Transaksidagang::join('users', 'transaksidagang.iduser', '=', 'users.id')
      ->join('jenisbarang', 'transaksidagang.idbarang', '=', 'jenisbarang.id')
      ->select('transaksidagang.*', 'users.namauser', 'jenisbarang.namabarang')
      ->orderBy('transaksidagang.updated_at','desc')
      ->paginate(8);

      return view('web.datatransaksidagang', compact('datadagang'));
    }

    public function tabelTransDagang(Request $request)
    {
      $inputcari = $request->insert;
      if(!empty($inputcari))
      {
        $datadagang = Transaksidagang::join('users', 'transaksidagang.iduser', '=', 'users.id')
        ->join('jenisbarang', 'transaksidagang.idbarang', '=', 'jenisbarang.id')
        ->select('transaksidagang.*', 'users.namauser', 'jenisbarang.namabarang')
        ->where('jenisbarang.namabarang', 'like', '%'.$inputcari.'%')
        ->orWhere('transaksidagang.biaya', 'like', '%'.$inputcari.'%')
        ->orWhere('transaksidagang.jumlah', 'like', '%'.$inputcari.'%')
        ->orWhere('users.namauser', 'like', '%'.$inputcari.'%')
        ->orWhere('transaksidagang.created_at', 'like', '%'.$inputcari.'%')
        ->orderBy('transaksidagang.updated_at','desc')
        ->paginate(8);
        //dd($databarang);
        return view('layouts.tabeldatatransaksidagang', compact('datadagang'));
      }
      $datadagang = Transaksidagang::join('users', 'transaksidagang.iduser', '=', 'users.id')
      ->join('jenisbarang', 'transaksidagang.idbarang', '=', 'jenisbarang.id')
      ->select('transaksidagang.*', 'users.namauser', 'jenisbarang.namabarang')
      ->orderBy('transaksidagang.updated_at','desc')
      ->paginate(8);

      return view('layouts.tabeldatatransaksidagang', compact('datadagang'));
    }

    public function deleteDataTransDagang($id)
    {
      $deletetrans = Transaksidagang::find($id);
      $deletetrans->delete();

      return redirect('datatransdagang');
    }

    public function multiDeleteDataDagang(Request $request)
    {
      $inputcari = $request->insert;
      if(empty($inputcari)){
        $iddatadagang = Transaksidagang::whereNotNull('id')->delete();

        return 'sukses';
      }
      $iddatadagang = Transaksidagang::join('users', 'transaksidagang.iduser', '=', 'users.id')
      ->join('jenisbarang', 'transaksidagang.idbarang', '=', 'jenisbarang.id')
      ->select('transaksidagang.id')
      ->where('jenisbarang.namabarang', 'like', '%'.$inputcari.'%')
      ->orWhere('transaksidagang.created_at', 'like', '%'.$inputcari.'%')->get();
      $deletedatadagang = Transaksidagang::whereIn('id', $iddatadagang)->delete();

      return 'sukses';
    }

}
