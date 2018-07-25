style="padding-left: 45px;" @extends('layouts.master')
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
    <li><a class="waves-effect black-text" href="regmember">Register member</a></li>
    <li><a class="waves-effect black-text" href="transmember">Transaksi member</a></li>
    <li><a class="waves-effect black-text" href="transaksidagang">Transaksi dagang</a></li>
    <ul class="collapsible">
    <li>
      <div class="collapsible-header" style="padding-left: 32px; font-size: 14px;
    font-weight: 500;">Master data</div>
      <div class="collapsible-body">
        <ul>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="datatransaksi">Data transaksi member</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="datatransdagang">Data transaksi dagang</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="datajenistransaksi">Data jenis transaksi</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="datamember">Data member</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="databarang">Data barang</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="pengeluaran">Data pengeluaran</a></li>
        </ul>
      </div>
    </li>
  </ul>
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="laporan">Laporan</a></li>
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
<div class="container">

<form action="{{url(action('LaporanController@getDataLaporan'))}}" method="get">
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

<div class="row">
  <div class="col s12">
      <div>
        <button class="waves-effect waves-light btn" type="submit">Cari</button>
      </div>
      @if ($message = Session::get('error'))
      <div class="center">
        <span class="sukses red-text"><b>{{$message}}</b></span>
      </div>
      @endif
  </div>
</div>
</form>
</div>


@endsection

@section('script')
<script>
$('*').click(function(){
  $('.sukses').fadeOut(1000);
});

$('.datepicker').datepicker({
  yearRange: 70,
  format: 'yyyy-mm-dd'
});


    $('input[type=radio][name=group1]').change(function() {
        var value = this.value;

        $.ajax({

          url : 'bulanselect',
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

        // if (this.value == 'hari') {
        //
        //   $('#tgl').prop('disabled',false);
        //   $('#tgl2').prop('disabled',false);
        //   $('#bulan').formSelect().attr('disabled','disabled');
        //
        // }
        // else if (this.value == 'bulan') {
        //
        // $('#bulan').formSelect().removeAttr('disabled');
        //
        //   $('#tgl2').prop('disabled',true);
        //   $('#tgl').prop('disabled',true);
        // }




</script>
@endsection
