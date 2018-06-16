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
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="/transaksidagang">Transaksi dagang</a></li>
    <li><a class="waves-effect black-text" href="/datatransaksi">Data transaksi</a></li>
    <li><a class="waves-effect black-text" href="/datamember">Data member</a></li>
    <li><a class="waves-effect black-text" href="/databarang">Data barang</a></li>
    <li><a class="sidenav-close hide-on-large-only">Tutup</a></li>
  </ul>
@endsection

@section('content')
<div class="container">
<div class="row">
  <h4 class="center-align">Transaksi Dagang</h4>
</div>
</div>
<div class="divider"></div>
<div class="container">
<br>

<form action="{{url(action('TambahdatabarangController@insertDataBarang'))}}" method="post">
  <div class="row">
    <div class="input-field col s12 m6 l6">
      <input name="namabarang" type="text" value="" id="autocomplete-input" class="autocomplete" autocomplete="off">
      <label for="autocomplete-input">Masukkan nama barang</label>

    </div>
    <div class="col s12 m6 l6">
      @if($errors->has('namabarang'))
        <p class="alert red-text">{{ $errors->first('namabarang') }}</p>
      @endif
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12 m6 l6">
      <input name="harga" id="harga" type="text" class="validate" value="{{ old('harga' )}}" autocomplete="off">
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
      <input name="stok" id="stok" type="text" class="validate" value="{{ old('stok' )}}" autocomplete="off">
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
        <a href="/databarang" class="waves-effect waves-light btn-large">Batal</a>
        &nbsp
        <button class="waves-effect waves-light btn-large" type="submit">Simpan</button>
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
$.ajax({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  method: "GET",
  url: "caribarang",
}).done(function(databarang){
  var data = databarang;
  var jsondata = JSON.stringify(data);
  var newSt = jsondata.replace(/[{}]/g, "");
  var newStr = newSt.replace(/\[/g, '{').replace(/]/g, '}');
  var obj = JSON.parse(newStr);

    $('#autocomplete-input').autocomplete({
      data:obj,
    })
  })

</script>
@endsection
