@extends('layouts.master')
@section('title')
  SISCM - Edit data barang
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
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="/datajenistransaksi">Data jenis transaksi</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="/datamember">Data member</a></li>
          <li class="active cyan lighten-5"><a class="waves-effect black-text" style="padding-left: 45px;" href="/databarang">Data barang</a></li>
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
  <h4 class="center-align">Edit Data Barang</h4>
</div>
</div>
<div class="divider"></div>
<div class="container">
<br>

<form action="/databarang/id{{ $barang->id }}" method="post">
  <input name="_method" type="hidden" value="PUT">
  <div class="row">
    <div class="input-field col s12 m6 l6">
      <input name="namabarang" id="namabarang" value="{{ $barang->namabarang }}" type="text" class="validate" autocomplete="off">
      <label for="namabarang">Nama Barang</label>

    </div>
    <div class="col s12 m6 l6">
      @if($errors->has('namabarang'))
        <p class="alert red-text">{{ $errors->first('namabarang') }}</p>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12 m6 l6">
      <input name="harga" id="harga" value="{{ $barang->harga }}" type="text" class="validate" autocomplete="off">
      <label for="harga">Harga</label>

    </div>
    <div class="col s12 m6 l6">
      @if($errors->has('harga'))
        <p class="alert red-text">{{ $errors->first('harga') }}</p>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12 m6 l6">
      <input name="stok" id="stok" value="{{ $barang->stok }}" type="text" class="validate" autocomplete="off">
      <label for="stok">Jumlah stok</label>
    </div>
    <div class="col s12 m6 l6">
      @if($errors->has('stok'))
        <p class="alert red-text">{{ $errors->first('stok') }}</p>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12 m6 l6">
      <div class="right">
        <a href="/databarang" class="btn waves-effect waves-light btn-small grey darken-2">Kembali</a>
        &nbsp
        <button class="btn waves-effect waves-light btn-small grey darken-2" type="submit">Simpan</button>
    </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="col s12 m6 l6">
      <p class="sukses left light-green-text text-accent-4"><b>{{$message}}</b></p>
    </div>
    @endif
  </div>
  {{ csrf_field() }}
<form>
</div>




@endsection

@section('script')
<script>
  $('*').click(function(){
    $('.alert').fadeOut(1000);
    $('.sukses').fadeOut(1000);
  })
</script>
@endsection
