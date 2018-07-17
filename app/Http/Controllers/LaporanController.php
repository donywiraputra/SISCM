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
    public function getLaporan()
    {
      return view('web.laporan');

      // $transdagang = Transaksidagang::select(DB::raw('SUM(biaya) as total'), DB::raw('count(idbarang) as dagang'), DB::raw('day(created_at) as tanggal')) //selectRaw('SUM(biaya) as total')
      // ->groupBy('tanggal')
      // ->get()->groupBy('tanggal');

      // $transdagang->toArray();
      // $transdagang->all();
      // ->groupBy(function($date) {
      //   return Carbon::parse($date->updated_at)->format('d');
      // })

      // $transdagang[0]['keterangan'] = 'total dagang';
      // $transdagang->toArray();

      // $transmember = Datatransaksi::join('jenistransaksi', 'datatransaksi.idjenistransaksi', '=', 'jenistransaksi.idjnstransaksi')
      // ->select(DB::raw('day(datatransaksi.created_at) as tanggal'), DB::raw('count(jenistransaksi.namatransaksi) as transaksimember'), DB::raw('SUM(jenistransaksi.biaya) as totaltrans'))
      // ->groupBy('tanggal')
      // ->get()
      // ->groupBy('tanggal')
      // ->union($transdagang)->all();





      // $tes = $transmember->push($transdagang);

      // $tes->all();


      // dd($transmember);
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


         // foreach ($tes as $key => $v) {
         //   foreach ($v as $k => $val) {
         //     $tes[$key]['total']['totaldebit'] = array_sum(array_column($v, 'debit'));
         //     $tes[$key]['total']['totalkredit'] = array_sum(array_column($v, 'kredit'));
         //     dd($tes);
         //   }
         //
         // }



         return view('web.showlaporan', compact('tes'));
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
             ;
         }
        $kredit = $pengeluaran->groupBy(function($date) {
          return Carbon::parse($date->tanggal)->format('F Y');
        })->toArray();

         $tes = array_merge_recursive($dagang,$member,$kredit);
         ksort($tes);


         return view('web.showlaporanbulan', compact('tes'));
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
