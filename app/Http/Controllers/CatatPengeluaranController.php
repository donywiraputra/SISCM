<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;

class CatatPengeluaranController extends Controller
{
    public function getCatatPengeluaran()
    {
      return view('web.catatpengeluaran');
    }

    public function catatPengeluaran(Request $request)
    {
      $this->validate($request,
      [
        'keterangan'=> 'required',
        'jumlah'=> 'required',
      ],
      [
        'keterangan.required'=> 'Keterangan harus diisi',
        'jumlah.required'=> 'Jumlah harus diisi',
      ]);
      $jml = $request->jumlah;
      $catat = new Pengeluaran();
      $catat->keterangan = $request->keterangan;
      $conv = str_replace( ',', '', $jml );
      $catat->jumlah = $conv;
      $userid = Auth::user();
      $catat->iduser = $userid->id;
      $catat->save();

      return redirect('catatpengeluaran')->with(['success' => 'Data berhasil disimpan']);
    }
}
