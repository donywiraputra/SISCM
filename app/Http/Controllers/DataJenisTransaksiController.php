<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jnstransaksi;

class DataJenisTransaksiController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getDataJenisTransaksi()
    {
      $datajnstrans = Jnstransaksi::all();

      return view('web.datajenistransaksi', compact('datajnstrans'));
    }

    public function editJenisTransaksi($id)
    {
      $jenistransaksi = Jnstransaksi::where('idjnstransaksi', '=', $id)->first();

      return view('web.editjenistransaksi', compact('jenistransaksi'));
    }

    public function updateJenisTransaksi(Request $request, $id)
    {
      $this->validate($request,
      [
        'biaya'=> 'required'
      ],
      [
        'biaya.required'=> 'Biaya harus diisi'
      ]);
      $biaya = $request->biaya;
      $convbiaya = str_replace(",", "", $biaya);
    
      $updatebiayatrans = Jnstransaksi::where('idjnstransaksi', '=', $id)->first();
      $updatebiayatrans->biaya = $convbiaya;
      $updatebiayatrans->save();

      return redirect('datajenistransaksi')->with(['success' => 'Data berhasil disimpan']);
    }
}
