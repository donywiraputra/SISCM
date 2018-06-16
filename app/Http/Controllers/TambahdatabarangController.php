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
      $this->validate($request,
      [
        'namabarang'=> 'required|unique:jenisbarang,namabarang',
        'harga'=> 'required|numeric',
        'stok'=> 'required|numeric'
      ],
      [
        'namabarang.required'=> 'Nama barang harus diisi',
        'namabarang.unique'=> 'Barang sudah ada',
        'harga.required'=> 'Harga harus diisi',
        'harga.numeric'=> 'Harga harus berupa angka',
        'stok.required'=> 'Stok harus diisi',
        'stok.numeric'=> 'Stok harus berupa angka'
      ]);
      $databarang = new Datajenisbarang;
      $databarang->namabarang = $request->namabarang;
      $databarang->harga = $request->harga;
      $databarang->stok = $request->stok;
      $userid = Auth::user();
      $databarang->iduser = $userid->id;
      $databarang->save();

      return redirect('databarang/tambahdatabarang')->with(['success' => 'Data berhasil disimpan']);
    }

    

}
