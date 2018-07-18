<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datatransaksi;
use App\Models\Transaksidagang;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function getLaporan()
    {
      return view('web.laporan');
    }

    public function getDataLaporan(Request $request)
    {
      $req = $request->group1;
      if ( $req == 'hari'){
        $tgldari = $request->dari;
        $tglsampai = $request->sampai;

        $transdagang = Transaksidagang::select(DB::raw('SUM(biaya) as debit'), DB::raw('date(created_at) as tanggal')) //select(DB::raw('SUM(biaya) as totaldagang'))
        ->whereBetween('created_at', [$tgldari, $tglsampai])->groupBy('tanggal')->get();
        foreach ($transdagang as $key => $value) {
             $transdagang[$key]['keterangan'] = 'Transaksi dagang';
             $transdagang[$key]['kredit'] = '';
         }
        $dagang = $transdagang->groupBy(function($date) {
          return Carbon::parse($date->tanggal)->format('d F Y');
        })->toArray();

        $transmember = Datatransaksi::join('jenistransaksi', 'datatransaksi.idjenistransaksi', '=', 'jenistransaksi.idjnstransaksi')
        ->select(DB::raw('SUM(jenistransaksi.biaya) as debit'), DB::raw('date(datatransaksi.created_at) as tanggal'))
        ->whereBetween('datatransaksi.created_at', [$tgldari, $tglsampai])->groupBy('tanggal')->get();
        foreach ($transmember as $key => $value) {
          $transmember[$key]['keterangan'] = 'Transaksi member';
          $transmember[$key]['kredit'] = '';
          }
        $member = $transmember->groupBy(function($date) {
          return Carbon::parse($date->tanggal)->format('d F Y');
        })->toArray();

        $pengeluaran = Pengeluaran::select('keterangan', DB::raw('SUM(jumlah) as kredit'), 'created_at')
        ->whereBetween('created_at', [$tgldari, $tglsampai])->groupBy('created_at')->get();

        foreach ($pengeluaran as $key => $value) {
             $pengeluaran[$key]['debit'] = '';
         }
        $kredit = $pengeluaran->groupBy(function($date) {
          return Carbon::parse($date->created_at)->format('d F Y');
        })->toArray();

         $tes = array_merge_recursive($dagang,$member,$kredit);
         ksort($tes);

         if(empty($tes)){
           return redirect('laporan')->with(['error' => 'Laporan tidak tersedia']);
         }else{
           return view('web.showlaporan', compact('tes'));
         }
      }

      if ( $req == 'bulan'){
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $transdagang = Transaksidagang::select(DB::raw('SUM(biaya) as debit'), DB::raw('date(created_at) as tanggal')) //select(DB::raw('SUM(biaya) as totaldagang'))
        ->whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->groupBy('tanggal')->get();
        foreach ($transdagang as $key => $value) {
             $transdagang[$key]['keterangan'] = 'Transaksi dagang';
             $transdagang[$key]['kredit'] = '';
         }
        $dagang = $transdagang->groupBy(function($date) {
          return Carbon::parse($date->tanggal)->format('F Y');
        })->toArray();

        $transmember = Datatransaksi::join('jenistransaksi', 'datatransaksi.idjenistransaksi', '=', 'jenistransaksi.idjnstransaksi')
        ->select(DB::raw('SUM(jenistransaksi.biaya) as debit'), DB::raw('date(datatransaksi.created_at) as tanggal'))
        ->whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->groupBy('tanggal')->get();
        foreach ($transmember as $key => $value) {
          $transmember[$key]['keterangan'] = 'Transaksi member';
          $transmember[$key]['kredit'] = '';
          }
        $member = $transmember->groupBy(function($date) {
          return Carbon::parse($date->tanggal)->format('F Y');
        })->toArray();

        $pengeluaran = Pengeluaran::select('keterangan', DB::raw('SUM(jumlah) as kredit'), DB::raw('date(created_at) as tanggal'))
        ->whereYear('created_at', $tahun)->whereMonth('created_at', $bulan)->groupBy('created_at')->get();
        foreach ($pengeluaran as $key => $value) {
             $pengeluaran[$key]['debit'] = '';
         }
        $kredit = $pengeluaran->groupBy(function($date) {
          return Carbon::parse($date->tanggal)->format('F Y');
        })->toArray();

         $tes = array_merge_recursive($dagang,$member,$kredit);
         ksort($tes);

         if(empty($tes)){
           return redirect('laporan')->with(['error' => 'Laporan tidak tersedia']);
         }else{
           return view('web.showlaporanbulan', compact('tes'));
         }
      }
    }

    public function selectBulan(Request $request)
    {
      $value = $request->insert;
      if( $value == 'bulan'){
        return view('layouts.selectbulan');
      }else{
        return view('layouts.selectbulandisabled');
      }
    }
}
