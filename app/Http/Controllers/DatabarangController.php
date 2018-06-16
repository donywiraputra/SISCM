<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datajenisbarang;
use Illuminate\Support\Facades\Auth;

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

    public function editDataBarang($id)
    {
      $barang = Datajenisbarang::join('users', 'jenisbarang.iduser', '=', 'users.id')
      ->select('jenisbarang.*', 'users.namauser')
      ->where('jenisbarang.id', '=', $id)->first();

      return view('web.editdatabarang', compact('barang'));
    }

    public function updateDataBarang(Request $request, $id)
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
      $updatebarang = Datajenisbarang::where('id', $id)->first();
      $updatebarang->namabarang = $request->namabarang;
      $updatebarang->harga = $request->harga;
      $updatebarang->stok = $request->stok;
      $userid = Auth::user();
      $updatebarang->iduser = $userid->id;
      $updatebarang->save();

      return redirect('databarang')->with(['success' => 'Data berhasil disimpan']);
    }

    public function deleteDataBarang($id)
    {
      $deletebarang = Datajenisbarang::find($id);
      $deletebarang->delete();

      return redirect('databarang');
    }

}
