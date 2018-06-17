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

<form action="{{url(action('TransaksidagangController@insertTransaksiDagang'))}}" method="post">
  <div class="row">
    <div class="input-field col s12 m6 l6">
      <input name="namabarang" type="text" value="" id="autocomplete-input" class="autocomplete" autocomplete="off">
      <label for="autocomplete-input">Masukkan nama barang</label>
    </div>
    <div class="col s12 m6 l6">
        <p class="nodata red-text"></p>
    </div>
  </div>

  <div class="row">
    <div class="col s12 m3 l3">
      <input name="jumlah" id="jumlah" type="text" class="validate" value="" autocomplete="off">
      <label for="jumlah">Jumlah</label>
    </div>

    <div class="col s12 m3 l3">
      <input disabled name="harga" id="harga" type="text" class="validate" value="" autocomplete="off">
      <label for="harga">Harga</label>
    </div>
  </div>

  <div class="row">
    <div class="col s12 m3 l3">
      <input name="bayar" id="bayar" type="text" class="validate" autocomplete="off">
      <label for="bayar">Bayar</label>
    </div>
    <div class="col s12 m3 l3">
      <span id="pesan"></span>
    </div>
  </div>

  <div class="row">
    <div class="input-field col s12 m6 l6">
      <div class="right">
        <a id="cancel" class="waves-effect waves-light btn-large">Cancel</a>&nbsp;
        <a id="proses" class="waves-effect waves-light btn-large disabled">Proses</a>
    </div>
    </div>
    <div class="col s12 m6 l6">

    @if ($message = Session::get('success'))
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
})
// autocomplete nama barang
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

// validasi nama barang & autofill jumlah + harga
$('#autocomplete-input').change(function(){
  var value = $(this).val();
  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    method: "GET",
    url: "validasibarang",
    data: {input: value}
  }).done(function(barang){
      var data = barang;
      var harga = data.harga;
      var conv = (harga/1000).toFixed(3).replace(/\./g, ',');
      var stok = data.stok;

    if(data === ''){
      $('.nodata').text('Data tidak ditemukan').fadeIn(0);
      $('#jumlah').val('');
      $('#harga').val('');
      $(document).click(function(){
        $('.nodata').fadeOut(1000);
      })
    }else if(stok == 0){
      $('.nodata').text('Stok barang habis').fadeIn(0);
      $('#jumlah').val('');
      $('#harga').val('');
      $(document).click(function(){
        $('.nodata').fadeOut(1000);
      })
    }else{
    $('#jumlah').val(1);
    $('#harga').val('Rp. '+ conv);
    }
    $('#jumlah').keyup(function(){
        var jml = $(this).val();
        var kali = jml * harga;
        var kali2 = (kali/1000).toFixed(3).replace(/\./g, ',');
      $('#harga').val('Rp. '+ kali2);
    })

    // validasi pembayaran
    $('#bayar').keyup(function(){
      var uang = $(this).val();
      var namabarang = $('#autocomplete-input').val();
      var jumlah = $('#jumlah').val();
      var bayar = jumlah * harga;

      if(uang == bayar){
        $('#pesan').html('<b class="light-green-text text-accent-4">Uang pas</b>').fadeIn(0);
        $('#proses').attr('class', 'waves-effect waves-light btn-large');
      }else if(uang == ''){
        $('#pesan').fadeOut(1000);
        $('#proses').attr('class', 'waves-effect waves-light btn-large disabled');
      }else if(uang > bayar){
        var kembali = uang - bayar;
        var kembaliconv = (kembali/1000).toFixed(3).replace(/\./g, ',');
        $('#pesan').html('<b class="light-green-text text-accent-4">Kembali Rp. '+kembaliconv+'</b>').fadeIn(0);
        $('#proses').attr('class', 'waves-effect waves-light btn-large');
      }else if(uang < bayar){
        $('#pesan').html('<b class="red-text">Uang kurang</b>').fadeIn(0);
        $('#proses').attr('class', 'waves-effect waves-light btn-large disabled');
      }else if( $.isNumeric(uang) == false ){
        $('#pesan').html('<b class="red-text">Input bayar harus angka</b>').fadeIn(0);
        $('#proses').attr('class', 'waves-effect waves-light btn-large disabled');
      }
    })

    $('#proses').click(function(){
      if(stok == 0){
        $('#pesan').html('<b class="red-text">Stok barang habis</b>').fadeIn(0);
      }else{
        $('form').submit();
      }
    })

  })
})




</script>
@endsection
