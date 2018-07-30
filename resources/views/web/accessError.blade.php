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
      <div class="message" style="font-size: 80px; margin-bottom: 30px; margin-top: 100px; text-align: center; color: #bdbdbd; font-weight: 100; ">
          Akses ini hanya untuk admin
      </div>
    </div>
  </div>

  @endsection
