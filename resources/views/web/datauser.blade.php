@extends('layouts.master')
@section('title')
  SISCM - Data user
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
    <li><a class="waves-effect black-text" href="/">Home</a></li>
    <li><a class="waves-effect black-text" href="regmember">Register member</a></li>
    <li><a class="waves-effect black-text" href="transmember">Transaksi member</a></li>
    <li><a class="waves-effect black-text" href="transaksidagang">Transaksi dagang</a></li>
    <ul class="collapsible">
    <li class="active">
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
          <li class="active cyan lighten-5"><a class="waves-effect black-text" style="padding-left: 45px;" href="datauser">Data user</a></li>
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
  <h4 class="center-align">Data User</h4>
</div>
</div>
<div class="divider"></div>
<div class="container">
<br>

<div class="row">
  @if ($message = Session::get('success'))
    <span id="sukses" class="light-green-text text-accent-4"><b>{{$message}}</b></span>
  @endif
    <span id="warning" class="red-text"></span>
</div>

  <div class="row">
    <div class="col s12">
    <table class="responsive-table highlight">
      <thead>
        <tr>
            <th>Nama user</th>
            <th>Nama lengkap</th>
            <th>Level user</th>
            <th></th>
            <th></th>
        </tr>
      </thead>
      <tbody id="transdata">
        @foreach($getuser as $datauser)
        <tr>
          <td>{{ $datauser->namauser }}</td>
          <td>{{ $datauser->namalengkap }}</td>
          <td>{{ $datauser->namarole }}</td>
          <td><a href="datauser/{{ $datauser->id }}/edit" class="btn waves-effect waves-light btn-small grey darken-2">Edit</a></td>
          <td><a data-target="modal{{ $datauser->id }}" id="modalalert" class="modal-trigger btn waves-effect waves-light btn-small grey darken-2">Hapus</a></td>
        </tr>

        <!-- Modal Structure -->
          <div id="modal{{ $datauser->id }}" class="modal">
            <div class="modal-content">

              <p>Apakah anda yakin ingin menghapus data user <b>{{ $datauser->namauser }}</b>?</p>
            </div>
            <div class="modal-footer">
              <a class="modal-close waves-effect waves-green btn-flat">Tidak</a>
              <a href="/datauser/{{ $datauser->id }}/delete" class="modal-close waves-effect waves-green btn-flat">Ya</a>
            </div>
          </div>
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
   $('.modal').modal({
      dismissible: false
   });

  $('*').click(function(){
    $('#sukses').fadeOut(1000);
  })
});
</script>
@endsection
