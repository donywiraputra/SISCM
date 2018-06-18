<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datajenisbarang;
use App\Models\Transaksidagang;
use Illuminate\Support\Facades\Auth;

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

    public function validasiBarang(Request $request)
    {
      $data = $request->input;
      $databarang = Datajenisbarang::where('namabarang', '=', $data)
      ->first();

      return $databarang;
    }

    public function subTotalDagang(Request $request)
    {
      $namabarang = $request->barang;
      $jumlahbarang = $request->jumlah;
      $barang = Datajenisbarang::where('namabarang', $namabarang)->first();
      $harga = $barang->harga;
      $subtotal = $jumlahbarang * $harga;

      return $subtotal;
    }

    public function insertTransaksiDagang(Request $request)
    {
      $transaksidagang = new Transaksidagang;
      $namabarang = $request->namabarang;
      $barang = Datajenisbarang::where('namabarang', $namabarang)->first();
      $harga = $barang->harga;
      $jml = $request->jumlah;
      $transaksidagang->idbarang = $barang->id;
      $transaksidagang->jumlah = $request->jumlah;
      $transaksidagang->biaya = $harga * $jml;
      $userid = Auth::user();
      $transaksidagang->iduser = $userid->id;
      $stok = $barang->stok;
      $barang->stok = $stok - $jml;
      $transaksidagang->save();
      $barang->save();

      return redirect('transaksidagang')->with(['success' => 'Transaksi berhasil diproses']);
    }
}
