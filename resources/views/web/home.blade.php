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
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="/">Home</a></li>
    <li><a class="waves-effect black-text" href="regmember">Register member</a></li>
    <li><a class="waves-effect black-text" href="transmember">Transaksi member</a></li>
    <li><a class="waves-effect black-text" href="transaksidagang">Transaksi dagang</a></li>
    <li><a class="waves-effect black-text" href="datatransaksi">Data transaksi</a></li>
    <li><a class="waves-effect black-text" href="datamember">Data member</a></li>
    <li><a class="waves-effect black-text" href="databarang">Data barang</a></li>
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
  </div>




<div class="row">
  <div class="col s12" style="max-height:500px; overflow-y:auto;">

  <table class="responsive-table highlight">
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
})
</script>
@endsection
