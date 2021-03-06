@extends('layouts.master')
@section('title')
  SISCM - Home
@endsection
@section('header')
<nav class:"top-nav">
  <div class="nav-wrapper white">
    <div class:"row">
      <ul class="right">
        <li><a href="logout" class="waves-effect black-text">Log out</a></li>
        <li><a href="register" class="waves-effect black-text">Register</a></li>
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
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="/">Home</a></li>
    <li><a class="waves-effect black-text" href="regmember">Register member</a></li>
    <li><a class="waves-effect black-text" href="transmember">Transaksi member</a></li>
    <li><a class="waves-effect" href="transaksidagang">Transaksi dagang</a></li>
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
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="datauser">Data user</a></li>
        </ul>
      </div>
    </li>
  </ul>
    <li><a class="waves-effect black-text" href="laporan">Laporan</a></li>
    <li><a class="sidenav-close hide-on-large-only">Tutup</a></li>
  </ul>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <h4 class="center-align">Sistem Informasi Sanggar Catur Marga</h4>
  </div>
</div>
  <div class="divider"></div>
  <br>
  <div class="container">
    <div class="row">
      <span>List member yang expired dan akan expired:</span>
    </div>

<div class="row">
  <div class="col s12" style="max-height:500px; overflow-y:auto;">

  <table class="highlight">
    <thead>
      <tr>
          <th>Nama Member</th>
          <th>Nama Lengkap</th>
          <th>Kategori</th>
          <th>Exp</th>
      </tr>
    </thead>
    <tbody id="transdata">
      @foreach ($expdate as $expmember)
      <tr id="data">
        <td>{{ $expmember->namamember }}</td>
        <td>{{ $expmember->namalengkap }}</td>
        <td>{{ $expmember->katmember }}</td>
        <td id="exp">{{ $expmember->expired_date }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>

<br>
  <div class="row">
    <span>Stok barang yang habis dan akan habis:</span>
  </div>

<div class="row">
  <div class="col s12" style="max-height:500px; overflow-y:auto;">

  <table class="highlight">
    <thead>
      <tr>
          <th>Nama barang</th>
          <th class="center">Stok</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($stokbarang as $stok)
      <tr id="data">
        <td>{{ $stok->namabarang }}</td>
        <td id="stok" class="center">{{ $stok->stok }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function(){
  $('#data #exp').each(function(){
    var exp = $(this).text(),
        waktuexp = new Date(exp),
        msec = Date.parse(waktuexp),
        submsec = msec - 432000000,
        msecdate = new Date(submsec),
        now = new Date();
    if(now >= waktuexp){
      $(this).addClass("red-text text-accent-3");
    }
    if( now >= msecdate && now < waktuexp){
      $(this).addClass("amber-text");
    }
    if( now < msecdate ){
      $(this).addClass("light-green-text text-accent-4");
    }
    if( exp === '' ){
      $(this).text('Harian');
    }
  });

  $('#data #stok').each(function(){
    var stok = $(this).text();
    if(stok == 0){
      $(this).addClass("red-text text-accent-3");
    }else if(stok <= 3){
      $(this).addClass("amber-text");
    }
  })
})
</script>
@endsection
