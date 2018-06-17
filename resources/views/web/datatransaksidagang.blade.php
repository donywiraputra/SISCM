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
    <li><a class="waves-effect black-text" href="transaksidagang">Transaksi dagang</a></li>
    <li><a class="waves-effect black-text" href="datatransaksi">Data transaksi member</a></li>
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="#!">Data transaksi dagang</a></li>
    <li><a class="waves-effect black-text" href="datamember">Data member</a></li>
    <li><a class="waves-effect black-text" href="databarang">Data barang</a></li>
    <li><a class="sidenav-close hide-on-large-only">Tutup</a></li>
  </ul>
@endsection

@section('content')
<div class="container">
<div class="row">
  <h4 class="center-align">Data Transaksi Dagang</h4>
</div>
</div>
<div class="divider"></div>
<div class="container">
<br>

<div class="row">
  <div class="input-field col s12 m6 l6">
    <input name="inputdata" placeholder="Cari data..." id="caridata" type="text" class="validate" autocomplete="off">
    <label for="caridata">Pencarian</label>
  </div>
    @if ($message = Session::get('success'))
      <span class="sukses light-green-text text-accent-4"><b>{{$message}}</b></span>
    @endif
      <span id="warning" class="red-text"></span>
      <div class="right">
        <ul>
          <li><a href="#!" class="btn waves-effect waves-teal btn-flat right">Print view</a></li>
          <li><a href="/databarang/tambahdatabarang" class="btn waves-effect waves-teal btn-flat right">Tambah barang baru</a></li>
        <ul>
      </div>
</div>

</div>

<div class="tabelbarang">
    @include('layouts.tabeldatatransaksidagang')
</div>

@endsection
