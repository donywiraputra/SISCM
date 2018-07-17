@extends('layouts.master')
@section('header')
<nav class:"top-nav">
  <div class="nav-wrapper white">
    <div class:"row">
      <ul class="right">
        <li><a href="logout" class="waves-effect waves-green grey-text">Log out</a></li>
        <li><a href="register" class="waves-effect waves-green grey-text">Register</a></li>
      </ul>
        <a href="#" data-target="slide-out" class="sidenav-trigger hide-on-large-only"><i class="material-icons" id="sidenavbtn">menu</i></a>
    </div>
  </div>
</nav>

  <ul id="slide-out" class="sidenav sidenav-fixed white">
    <li>
      <div class="user-view center">
        <img class="responsive-img" src="/images/sis-logo.png">
        <p class="name">nama user:<br>{{ auth()->user()->namalengkap }}</p>
      </div>
    </li>
    <div class="divider"></div>

    <li><div class="divider"></div></li>
    <li><a class="waves-effect black-text" href="/">Home</a></li>
    <li><a class="waves-effect black-text" href="/regmember">Register member</a></li>
    <li><a class="waves-effect black-text" href="/transmember">Transaksi member</a></li>
    <li><a class="waves-effect black-text" href="/transaksidagang">Transaksi dagang</a></li>
    <li><a class="waves-effect black-text" href="/datatransaksi">Data transaksi member</a></li>
    <li><a class="waves-effect black-text" href="/datatransdagang">Data transaksi dagang</a></li>
    <li><a class="waves-effect black-text" href="/datamember">Data member</a></li>
    <li><a class="waves-effect black-text" href="/databarang">Data barang</a></li>
    <li><a class="waves-effect black-text" href="/pengeluaran">Data pengeluaran</a></li>
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="/laporan">Laporan</a></li>
    <li><a class="sidenav-close hide-on-large-only">Tutup</a></li>
  </ul>
@endsection

@section('content')
<div class="container">
<div class="row">
  <h4 class="center-align">Laporan</h4>
</div>
</div>
<div class="divider"></div>
<br>
<form action="{{url(action('LaporanController@getDataLaporan'))}}" method="get">
<div class="container">

<div class="row">
  <p>Pilih berdasarkan:</p>
  <div class="col s12">
    <label>
      <input id="tgl" value="hari" name="group1" type="radio" checked />
      <span>Hari</span>
    </label>
    </div>
    <div class="col s6">
    <div class="input-field">
      <input id="isitgl" name="dari" type="text" class="datepicker">
      <label for="dari">Dari tanggal</label>
    </div>
  </div>

  <div class="col s6">
    <div class="input-field">
      <input id="isitgl2" name="sampai" type="text" class="datepicker">
      <label for="sampai">Sampai tanggal</label>
    </div>
  </div>

</div>

<div class="row">
  <div class="col s12">
    <label>
      <input id="tgl2" value="bulan" name="group1" type="radio"/>
      <span>Bulan</span>
    </label>
  </div>
  <div class="col s6">
    <div class="selectbulan">
      @include('layouts.selectbulandisabled')
  </div>
  </div>
  <div class="col s6">
    <div class="input-field">
      <input id="tahun" name="tahun" type="text" class="validate" disabled>
      <label for="tahun">Tahun</label>
    </div>
  </div>
</div>
</form>
<div class="col s12">
  <div class="row">
    <button class="waves-effect waves-light btn-large" type="submit">Lanjut</button>
  </div>
</div>



<div class="row">
<div class="col s12">
  @foreach ($tes as $key => $value)

  <p class="center" style="padding: 5px; background-color: #fafafa; "><b>{{ $key }}</b></p>
  <table>

        <thead>
          <tr>
              <th>Keterangan</th>
              <th>Debit</th>
              <th>Kredit</th>

          </tr>
        </thead>

        <tbody>
          @foreach ($value as $k => $v)
          <tr id="laporan">
            <td>{{ $v['keterangan'] }} | {{date('d F Y', strtotime($v['tanggal']))}}</td>
            <td id="debit">{{ $v['debit'] }}</td>
            <td id="kredit">{{ $v['kredit'] }}</td>

          </tr>
          @endforeach
          <tr>
            <td><b>Total</b></td>
            <td id="totaldebit"></td>
            <td id="totalkredit"></td>

          </tr>
        </tbody>

      </table>
      <br>
 @endforeach
</div>
</div>
</div>

@endsection

@section('script')
<script>
$('.datepicker').datepicker({
  yearRange: 70,
  format: 'yyyy-mm-dd'
});

$('input[type=radio][name=group1]').change(function() {
    var value = this.value;

    $.ajax({

      url : '/bulanselect',
      data: {insert: value}
    }).done(function(data){
      if (value == 'hari') {
        $('#isitgl').prop('disabled',false);
        $('#isitgl2').prop('disabled',false);
          $('#tahun').prop('disabled',true);
        $('.selectbulan').html(data);
        $(document).ready(function(){
          $('select').formSelect();
        });
      }else if (value == 'bulan'){
      $('#isitgl').prop('disabled',true);
      $('#isitgl2').prop('disabled',true);
      $('#tahun').prop('disabled',false);
      $('.selectbulan').html(data);
      $(document).ready(function(){
        $('select').formSelect();
      });
    }
    })

});

$(document).ready(function(){
  var sumdebit = 0;
  var sumkredit = 0;
  $('#laporan #debit').each(function(){
    var debit = $(this).text();
    var convdebit = debit.replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if ( debit == '' ){
      $(this).text('');
    }else{
    $(this).text('Rp. '+convdebit);
  }
  var intdebit = debit * 1;
  sumdebit += intdebit;

  })

  $('#laporan #kredit').each(function(){
    var kredit = $(this).text();
    var convkredit = kredit.replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if ( kredit == '' ){
      $(this).text('');
    }else{
    $(this).text('Rp. '+convkredit);
  }
  var intkredit = kredit * 1;
  sumkredit += intkredit;

  })

  var sumstringd = sumdebit.toString();
  var sumformatd = sumstringd.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  var sumstringk = sumkredit.toString();
  var sumformatk = sumstringk.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    $('#totaldebit').text('Rp. '+sumformatd);
    $('#totalkredit').text('Rp. '+sumformatk);
})


</script>
@endsection
