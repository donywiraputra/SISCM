@extends('layouts.master')
@section('title')
  SISCM - Edit user
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
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="/databarang">Data barang</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="/pengeluaran">Data pengeluaran</a></li>
          <li class="active cyan lighten-5"><a class="waves-effect black-text" style="padding-left: 45px;" href="/datauser">Data user</a></li>
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
  <h4 class="center-align">Edit Data User</h4>
</div>
</div>
<div class="divider"></div>
<div class="container">
<br>

<div class="row">
  <div class="col s12 m8 offset-m2">
    <div class="card">

      <div class="card-content grey lighten-5">

        <form action="/datauser/{{ $edituser->id }}" method="post">
          <input name="_method" type="hidden" value="PUT">
          <div class="row">
            <div class="input-field">
              <input name="nama" type="text" class="validate" value="{{ $edituser->namauser }}" autocomplete="off">
              <label for="nama">Nama User</label>
            </div>
            <div>
              @if($errors->has('nama'))
                <p class="alert red-text">{{ $errors->first('nama') }}</p>
              @endif
            </div>
          </div>

          <div class="row">
            <div class="input-field">
              <input name="namalengkap" type="text" class="validate" value="{{ $edituser->namalengkap }}" autocomplete="off">
              <label for="namalengkap">Nama lengkap</label>
            </div>
            <div>
              @if($errors->has('namalengkap'))
                <p class="alert red-text">{{ $errors->first('namalengkap') }}</p>
              @endif
            </div>
          </div>

          <div class="row">
            <a href="/datauser/{{ $edituser->id }}/editpassword">Ganti password</a>
          </div>

          <div class="row">
            <div class="right">
              <a href="/datauser" class="btn waves-effect waves-light btn-small grey darken-2">Batal</a>
              <button class="btn waves-effect waves-light btn-small grey darken-2" type="submit">Simpan</button>
            </div>
          </div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
  </div>
</div>

</div>


@endsection
