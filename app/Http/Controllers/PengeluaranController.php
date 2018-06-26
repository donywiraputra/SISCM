<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function getPengeluaran()
    {
      $pengeluaran = Pengeluaran::join('users', 'pengeluaran.iduser', '=', 'users.id')
      ->select('pengeluaran.*', 'users.namauser')
      ->orderBy('updated_at', 'desc')->paginate(8);

      return view('web.datapengeluaran', compact('pengeluaran'));
    }

    public function tabelPengeluaran(Request $request)
    {
      $inputcari = $request->insert;
      if(!empty($inputcari))
      {
        $pengeluaran = Pengeluaran::join('users', 'pengeluaran.iduser', '=', 'users.id')
        ->select('pengeluaran.*', 'users.namauser')
        ->where('pengeluaran.keterangan', 'like', '%'.$inputcari.'%')
        ->orWhere('pengeluaran.jumlah', 'like', '%'.$inputcari.'%')
        ->orWhere('users.namauser', 'like', '%'.$inputcari.'%')
        ->orWhere('pengeluaran.updated_at', 'like', '%'.$inputcari.'%')
        ->orderBy('pengeluaran.updated_at','desc')
        ->paginate(8);
        
        return view('layouts.tabelpengeluaran', compact('pengeluaran'));
      }
      $pengeluaran = Pengeluaran::join('users', 'pengeluaran.iduser', '=', 'users.id')
      ->select('pengeluaran.*', 'users.namauser')
      ->orderBy('updated_at', 'desc')->paginate(8);

      return view('layouts.tabelpengeluaran', compact('pengeluaran'));
    }

    public function editPengeluaran($id)
    {
      $pengeluaran = Pengeluaran::join('users', 'pengeluaran.iduser', '=', 'users.id')
      ->select('pengeluaran.*', 'users.namauser')
      ->where('pengeluaran.id', '=', $id)->first();

      return view('web.editdatapengeluaran', compact('pengeluaran'));
    }

    public function updatePengeluaran(Request $request, $id)
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
      $update = Pengeluaran::where('id', $id)->first();
      $update->keterangan = $request->keterangan;
      $jml = $request->jumlah;
      $conv = str_replace( ',', '', $jml );
      $update->jumlah = $conv;
      $userid = Auth::user();
      $update->iduser = $userid->id;
      $update->save();

      return redirect('pengeluaran')->with(['success' => 'Data berhasil disimpan']);
    }

    public function deletePengeluaran($id)
    {
      $deletedata = Pengeluaran::find($id);
      $deletedata->delete();

      return redirect('pengeluaran');
    }
}
