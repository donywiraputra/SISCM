<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datajenisbarang;
use App\Models\Transaksidagang;

class DatatransdagangController extends Controller
{
    public function getDataTransDagang()
    {
      $datadagang = Transaksidagang::join('users', 'transaksidagang.iduser', '=', 'users.id')
      ->join('jenisbarang', 'transaksidagang.idbarang', '=', 'jenisbarang.id')
      ->select('transaksidagang.*', 'users.namauser', 'jenisbarang.namabarang')
      ->orderBy('transaksidagang.updated_at','desc')
      ->paginate(8);

      return view('web.datatransaksidagang', compact('datadagang'));
    }
}
