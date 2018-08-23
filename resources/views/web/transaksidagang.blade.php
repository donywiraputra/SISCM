@extends('layouts.master')
@section('title')
  SISCM - Transaksi dagang
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
    <li><a class="waves-effect black-text" href="/regmember">Register member</a></li>
    <li><a class="waves-effect black-text" href="/transmember">Transaksi member</a></li>
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="/transaksidagang">Transaksi dagang</a></li>
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
  <h4 class="center-align">Transaksi Dagang</h4>
</div>
</div>
<div class="divider"></div>
<div class="row">
  <div class="col s12 m6 l6">
<div class="container">
<br>

<form action="{{url(action('TransaksidagangController@insertTransaksiDagang'))}}" method="post">
  <div class="row">
    <div class="input-field col s12">
      <input name="namabarang" type="text" value="" id="autocomplete-input" class="autocomplete" autocomplete="off">
      <label for="autocomplete-input">Masukkan nama barang</label>
    </div>
    <div class="col s12 m6 l6">
        <p class="nodata red-text"></p>
    </div>
  </div>

  <div class="row">
    <div class="col s12 m6 l6">
      <input name="jumlah" id="jumlah" type="text" value="" autocomplete="off">
      <label for="jumlah">Jumlah</label>
    </div>

    <div class="col s12 m6 l6">
      <input disabled name="harga" id="harga" type="text" value="" autocomplete="off">
      <label for="harga">Harga</label>
    </div>
  </div>

  <div class="row">
    <div class="col s12">
      <div class="right">
        <a id="catat" class="btn waves-effect waves-light btn-small grey darken-2">Catat</a>&nbsp;
        <a id="simpan" class="btn waves-effect waves-light btn-small grey darken-2 disabled">Simpan</a>
      </div>
    </div>
  {{ csrf_field() }}
</form>
</div>
</div>

</div>

<div class="row">
<div class="col s12 m6 l6">
  <div class="container">
    <br>
  <div class="row" style="background-color: #fafafa; border: 1px solid #e0e0e0;">
    <table class="centered">
       <thead>
         <tr class="head">
             <th>Barang</th>
             <th>Jumlah</th>
             <th>Subtotal</th>
             <th></th>
         </tr>
       </thead>

       <tbody class="list">
         <tr>
            <td></td>
            <td><b>Total</b></td>
            <td class="total"></td>
            <td></td>
         </tr>
       </tbody>
     </table>
  </div>

  <div class="row">
    <div class="col s12 m6 l6">
      <input disabled name="bayar" id="bayar" type="text" class="validate" autocomplete="off">
      <label for="bayar">Bayar</label>
    </div>
    <div class="col s12 m6 l6">
      <span id="pesan"></span>
      @if ($message = Session::get('success'))
      <p class="sukses left light-green-text text-accent-4"><b>{{$message}}</b></p>
      @endif
    </div>
  </div>

</div>
</div>
</div>
</div>

@endsection

@section('script')
<script>

$('*').click(function(){
  $('.alert').fadeOut(1000);
  $('.sukses').fadeOut(1000);
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



    $('#catat').off('click').click(function(){
      var namabarang = $('#autocomplete-input').val();
      var jumlah = $('#jumlah').val();
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: "GET",
        url: "getsubtotal",
        data: {barang: namabarang , jumlah: jumlah}
      }).done(function(subtotal){
        if(stok == 0){
          $('#pesan').html('<b class="red-text">Stok barang habis</b>').fadeIn(0);
        }else{
          $('#bayar').removeAttr("disabled");
        }
        total = 0;
        var sub = subtotal;
        var convsub = (sub/1000).toFixed(3).replace(/\./g, ',');
        $('.list').prepend('<tr class="data"><td class="namabarang">'+namabarang+'</td><td>'+jumlah+'</td><td class="subtotal">Rp. '+convsub+'</td><td><a id="deletelist" class="waves-effect waves-teal btn-flat"><i class="material-icons">clear</i></a></td></tr>');
        $('#autocomplete-input, #jumlah, #harga').val('').blur();
        $('.subtotal').each(function(){
          var harga = $(this).text().replace(/,/g , '').replace(/Rp/g , '').replace(/\./g , '');
              total += harga*1;
        })
        $('.total').text('Rp. '+(total/1000).toFixed(3).replace(/\./g, ','));

        $('#deletelist').click(function(){
          var name = $(this).closest('tr').find('.namabarang').text();
          var hargasub = $(this).closest('tr').find('.subtotal').text().replace(/,/g , '').replace(/Rp/g , '').replace(/\./g , '');
              total -= hargasub*1;

          $('.total').text('Rp. '+(total/1000).toFixed(3).replace(/\./g, ','));
          if (total == 0){
            $('.total').text('');
          }
          $(this).closest('tr').remove();

          $.ajax({
            method: "GET",
            url: "deletelist",
            data: {namabarang: name}
          })
        })
      })
    })

    // validasi pembayaran
    $('#bayar').keyup(function(){
      var uangconv = $(this).val().replace(/,/g , '');
      var uang = uangconv*1;

      if(event.which >= 37 && event.which <= 40) return;

      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
      });

      if(uang == total){
        $('#pesan').html('<b class="light-green-text text-accent-4">Uang pas</b>').fadeIn(0);
        $('#simpan').attr('class', 'waves-effect waves-teal transparent cyan-text text-darken-1 btn');
      }else if(uang == ''){
        $('#pesan').fadeOut(1000);
        $('#simpan').attr('class', 'waves-effect waves-light btn disabled');
      }else if(uang > total){
        var kembali = uang - total;
        var kembaliconv = (kembali/1000).toFixed(3).replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        $('#pesan').html('<b class="light-green-text text-accent-4">Kembali Rp. '+kembaliconv+'</b>').fadeIn(0);
        $('#simpan').attr('class', 'waves-effect waves-teal transparent cyan-text text-darken-1 btn');
      }else if(uang < total){
        $('#pesan').html('<b class="red-text">Uang kurang</b>').fadeIn(0);
        $('#simpan').attr('class', 'waves-effect waves-light btn disabled');
      }
    })
  })
})



$('#simpan').click(function(){
  $('form').submit();
})




</script>
@endsection
