@extends('layouts.master')
@section('title')
  SISCM - Edit jenis transaksi
@endsection
@section('header')
<nav class:"top-nav">
  <div class="nav-wrapper white">
    <div class:"row">
      <ul class="right">
        <li><a href="/logout" class="waves-effect black-text">Log out</a></li>
        <li><a href="/register" class="waves-effect black-text">Register</a></li>
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
    <ul class="collapsible">
    <li class="active">
      <div class="collapsible-header" style="padding-left: 32px; font-size: 14px;
    font-weight: 500;">Master data</div>
      <div class="collapsible-body">
        <ul>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="/datatransaksi">Data transaksi member</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="/datatransdagang">Data transaksi dagang</a></li>
          <li class="active cyan lighten-5"><a class="waves-effect black-text" style="padding-left: 45px;" href="/datajenistransaksi">Data jenis transaksi</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="/datamember">Data member</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="/databarang">Data barang</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="/pengeluaran">Data pengeluaran</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="/datauser">Data user</a></li>
        </ul>
      </div>
    </li>
  </ul>
    <li><a class="waves-effect black-text" href="/laporan">Laporan</a></li>
    <li><a class="sidenav-close hide-on-large-only">Tutup</a></li>
  </ul>
@endsection

@section('content')
<div class="container">
<div class="row">
  <h4 class="center-align">Edit Biaya Transaksi</h4>
</div>
</div>
<div class="divider"></div>
<div class="container">
<br>

<form action="/datajenistransaksi/{{ $jenistransaksi->idjnstransaksi }}" method="post">
  <input name="_method" type="hidden" value="PUT">

    <div class="row">
      <div class="col s12">

              <div class="input-field col s12 m6 l6">
                <input disabled id="namatransaksi" value="{{ $jenistransaksi->namatransaksi }}" type="text" class="validate">
                <label for="namatransaksi">Nama transaksi</label>
              </div>
              <div class="input-field col s12 m6 l6">
                <input name="biaya" id="biaya" value="{{ number_format($jenistransaksi->biaya) }}" type="text" class="validate" autocomplete="off">
                <label for="biaya">Biaya</label>
              </div>
              <div class="col s12 m6 l6">
                @if($errors->has('biaya'))
                  <p class="alert red-text">{{ $errors->first('biaya') }}</p>
                @endif
              </div>

              <div class="col s12">
                <div class="right">
                <a href="/datajenistransaksi" class="btn waves-effect waves-light btn-small grey darken-2">Batal</a>
                &nbsp
                <button class="btn waves-effect waves-light btn-small grey darken-2" type="submit">Simpan</button>
              </div>
              </div>

      </div>
    </div>
    {{ csrf_field() }}
</form>
</div>



@endsection
@section('script')
<script>
$('#biaya').keyup(function(){
  var uangconv = $(this).val().replace(/,/g , '');
  var uang = uangconv*1;

  if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
  })
</script>
@endsection
