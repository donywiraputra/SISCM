<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datajenisbarang;
use App\Models\Transaksidagang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

class TransaksidagangController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getTransaksiDagang(Request $request)
    {
      if ($request->session()->exists('barang')) {
      $request->session()->forget('barang');
      }

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
      $num = $request->jumlah;
      $jumlahbarang = intval($num);
      $barang = Datajenisbarang::where('namabarang', $namabarang)->first();
      $harga = $barang->harga;
      $subtotal = $jumlahbarang * $harga;
      $userid = Auth::user();
      $now = Carbon::now();
      $data = ['idbarang' => $barang->id, 'jumlah' => $jumlahbarang,
              'biaya' => $subtotal, 'iduser' => $userid->id,
              'created_at' => $now, 'updated_at' => $now];
      if (!$request->session()->exists('barang')) {
      $request->session()->put('barang', [$data]);
      }else{
      $request->session()->push('barang', $data);
      }


      return $subtotal;
    }

    public function insertTransaksiDagang(Request $request)
    {
      $value = $request->session()->get('barang');
      foreach ($value as $key => $v){
        $idbrg['idbarang'] = $v['idbarang'];
        $jml['jumlah'] = $v['jumlah'];
        $stokbarang = Datajenisbarang::select('stok')->whereIn('id', $idbrg)->get();
        foreach ($stokbarang as $a => $b){
          $stok['jumlah'] = $b['stok'];
        }
        foreach ($stok as $a => $b){
          $upstok['stok'] =  $stok[$a] - $jml[$a];
        }
        $updatebarang = Datajenisbarang::whereIn('id', $idbrg)->get();
        foreach ($updatebarang as $k => $v){
          $v->stok = $upstok['stok'];
          $v->save();
        }
      }
      $transaksidagang = Transaksidagang::insert($value);

      return redirect('transaksidagang')->with(['success' => 'Transaksi berhasil diproses']);      
    }
}
