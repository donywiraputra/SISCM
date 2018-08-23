@extends('layouts.master')
@section('title')
  SISCM - Pengeluaran
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
          <li class="active cyan lighten-5"><a class="waves-effect black-text" style="padding-left: 45px;" href="pengeluaran">Data pengeluaran</a></li>
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
  <h4 class="center-align">Data Pengeluaran</h4>
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

</div>

</div>

<div class="tabeldata">
  @include('layouts.tabelpengeluaran')
</div>

@endsection

@section('script')
<script>
$('*').click(function(){
  $('.sukses').fadeOut(1000);
});

$("#caridata").on("change", function() {
  var value = $(this).val().toLowerCase();

    $.ajax({
      url : '/pengeluaran/page',
      data: {insert: value}
    }).done(function(data1){
      var transdata = data1;
      var pesan = '<b>Data tidak tersedia.</b>'
      $('.tabeldata').html(data1);
      $(document).ready(function(){
         $('.modal').modal({
            dismissible: false
         });
       });
          var info = $('#infodata').html();
          if( info == 'No. <b></b> - <b></b> | Total <b>0</b> data' ){
          $('#warning').html(pesan).fadeIn(1, function(){
              $('#warning').html(pesan).fadeOut(5000);
            });
          }
      })
})

$(document).on('click','.pagination a',function(e){
  e.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  searchPage(page);
  })

  function searchPage(page)
  {
    var value = $('#caridata').val().toLowerCase();
    $.ajax({
      url : '/pengeluaran/page?page='+page,
      data: {insert: value}
    }).done(function(data){

      $('.tabeldata').html(data);
      location.hash=page;
      $(document).ready(function(){
         $('.modal').modal({
            dismissible: false
         });
       });
    })
  }

  $(document).ready(function(){
     $('.modal').modal({
        dismissible: false
     });
   });

</script>

@endsection
