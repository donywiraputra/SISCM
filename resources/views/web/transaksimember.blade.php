@extends('layouts.master')
@section('title')
  SISCM - Transaksi member
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
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="transmember">Transaksi member</a></li>
    <li><a class="waves-effect black-text" href="transaksidagang">Transaksi dagang</a></li>
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
  <h4 class="center-align">Transaksi Member</h4>
</div>
</div>
<div class="divider"></div>
<div class="container">
<br>

<div class="col s12 m6 l6">
  <span>Pilih member :</span>
  <form action="{{url(action('TransaksiController@postTrans'))}}" method="post">
    <div class="row">
      <div class="input-field col s12 m6 l6">
        <input name="namambr" type="text" value="" id="autocomplete-input" class="autocomplete" autocomplete="off">
        <label for="autocomplete-input">Masukkan nama member</label>
      </div>
      <div class="left col s12">
        <span id="alert" class="red-text"></span>
      </div>

      <div class=" left col s12 m6 l6">
        <div class="data">
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col s12 m6 l6">
        <select name="jtrans" id="slcttrs">
          <option disabled selected>Pilih jenis transaksi</option>
          <optgroup label="Fitness">
            @foreach ($fitness as $fts)
            <option id="fit_id" class="Fitness" value="{{ $fts->idjnstransaksi }}">{{ $fts->namatransaksi }}</option>
            @endforeach
          </optgroup>
          <optgroup label="Aerobic">
            @foreach ($aerobic as $aer)
            <option id="aer_id" class="Aerobic" value="{{ $aer->idjnstransaksi }}">{{ $aer->namatransaksi }}</option>
            @endforeach
          </optgroup>
          <optgroup label="Yoga">
            @foreach ($yoga as $yog)
            <option id="yog_id" class="Yoga" value="{{ $yog->idjnstransaksi }}">{{ $yog->namatransaksi }}</option>
            @endforeach
          </optgroup>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m6 l6">
        <input disabled name="biaya" id="biayatrs" type="text" class="" value="" autocomplete="off">
        <label for="biayatrs">Biaya</label>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m6 l6">
        <input name="bayar" id="bayartunai" type="text" class="" value="" autocomplete="off">
        <label for="bayartunai">Bayar</label>
      </div>

    </div>
    <div class="row">
      <div class="col s12 m6 l6">
      <a href="/" id="cancel" class="btn waves-effect waves-light btn-small grey darken-2">Kembali</a>&nbsp;
      <a id="proses" class="btn waves-effect waves-light btn-small grey darken-2 disabled">Proses</a>
    </div>
    <div class="col s12 m6 l6">
      <span id="pesan"></span>
      @if ($message = Session::get('success'))
        <p class="sukses light-green-text text-accent-4"><b>{{$message}}</b></p>
      @endif
    </div>

    </div>

    {{ csrf_field() }}
  </form>

</div>

<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Perhatian!</h4>
      <p id="isimodal"></p>
    </div>
    <div class="modal-footer">
      <button class="modal-close waves-effect waves-green btn-flat">Tutup</button>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
$('*').click(function(){
  $('p.sukses').fadeOut(3000);
});

//autocomplete nama member
$.ajax({
  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  method: "GET",
  url: "/carimember",
}).done(function(datamember){
  var data = datamember;
  var jsondata = JSON.stringify(data);
  var newSt = jsondata.replace(/[{}]/g, "");
  var newStr = newSt.replace(/\[/g, '{').replace(/]/g, '}');
  var obj = JSON.parse(newStr);

    $('#autocomplete-input').autocomplete({
      data:obj,
    })
  })


//isi otomatis collection ajax-jquey
  $('#autocomplete-input').change(function(){
    var name = $('#autocomplete-input').val();
  //  alert(name);
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      method: "GET",
      url: "/showmember",
      data: {input: name}
    }).done(function(member){
      $('.data').empty();
      $('#alert').empty();

      var datamember = member;
      var emp = datamember.namamember;
      if (emp === undefined){
        $('#alert').text("Data tidak ditemukan!");
      }else{
            var exp = datamember.expired_date;
            var collection1 = '<ul class="collection with-header"><li class="collection-header center"><h4 id="membernama">'+datamember.namamember+'</h4></li>';
            var collection2 = '<li class="collection-item">Nama lengkap: <b class="right">'+datamember.namalengkap+'</b></li>';
            var collection3 = '<li class="collection-item">Alamat: <b class="right">'+datamember.alamat+'</b></li>';
            var collection4 = '<li class="collection-item">Jenis kelamin: <b class="right">'+datamember.kelamin+'</b></li>';
            var collection5 = '<li class="collection-item kategori">Jenis member: <b id="kategori" class="right">'+datamember.katmember+'</b></li>';
            var collection6 = '<li class="collection-item">Expired: <b id="expdate" class="right">'+datamember.expired_date+'</b></li></ul>';
            if ( exp === null){
              $('.data').append(collection1+collection2+collection3+collection4+collection5);
            }else{
              $('.data').append(collection1+collection2+collection3+collection4+collection5+collection6);
            }
            $('#pesan').empty();
          }
      })
    })


//tabel transaksi
$('#slcttrs').change(function(){
  var trs = $('#slcttrs').val();
//  console.log(trs);
  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    method: "GET",
    url: "/biayatransaksi",
    data: {biaya: trs}
  }).done(function(databiaya){
    var kirimbiaya = databiaya;
    var conv = (kirimbiaya/1000).toFixed(3);
  //  console.log(tes);
    $('#biayatrs').val('Rp. '+conv);

    //Peringatan menggunakan Modals
    var nama = $('#membernama').text();
    var kategori = $('#kategori').text();
    var transvalue = $('select[name="jtrans"] :selected').attr('class');
    var transvalue2 = $('select[name="jtrans"] :selected').text();
    var modal = 'Member <b>'+nama+'</b> terdaftar sebagai member <b>'+kategori+'</b>. Silahkan pilih salah satu transaksi yang sesuai dengan kategori <b>'+kategori+'</b> atau buat member baru.'
    var modal2 = 'Member <b>'+nama+'</b> sudah terdaftar sebagai member <b>'+kategori+'</b>. Silahkan pilih transaksi perpanjang atau harian.'
    var modal3 = 'Member <b>'+nama+'</b> belum terdaftar sebagai member <b>'+kategori+'</b>. Silahkan pilih transaksi daftar bulanan atau harian.'
    var expired = $('#expdate').text();
    console.log(kategori);
    if( kategori == ''){
      $('#alert').text("Nama masih kosong!");
    }else if( !(kategori == transvalue) ){
      $('.modal').modal();
      $('.modal').modal('open');
      $('#isimodal').html(modal);
    }else if(!(expired == '') && /daftar/i.test(transvalue2)){
      $('.modal').modal();
      $('.modal').modal('open');
      $('#isimodal').html(modal2);
    }else if( expired == '' && /perpanjang/i.test(transvalue2)){
      $('.modal').modal();
      $('.modal').modal('open');
      $('#isimodal').html(modal3);
    }


    //validasi kolom bayar
    $('#bayartunai').keyup(function(){
      var uangconv = $(this).val().replace(/,/g , '');
      var bayar = uangconv*1;

      if(event.which >= 37 && event.which <= 40) return;

      // format number
      $(this).val(function(index, value) {
        return value
        .replace(/\D/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        ;
      });
      $('#pesan').fadeIn(1);

      var inputmbr = $('#autocomplete-input').val();

      if( inputmbr == '' ){
        $('#pesan').html('<b class="red-text">Nama member masih kosong</b>');
        $('#proses').attr('class', 'waves-effect waves-light btn-large disabled');
        $(this).val('');
      }else if( bayar == '' ){
        $('#pesan').html('<b class="red-text">Pembayaran masih kosong</b>');
        $('#proses').attr('class', 'waves-effect waves-light btn-large disabled');
      }else if( $.isNumeric(bayar) == false ){
        $('#pesan').html('<b class="red-text">Input bayar harus angka</b>');
        $('#proses').attr('class', 'waves-effect waves-light btn-large disabled');
      }else if(bayar > kirimbiaya){
        var kembali = bayar - kirimbiaya;
        var kembaliconv = (kembali/1000).toFixed(3);
        $('#pesan').html('<b class="light-green-text text-accent-4">Kembali Rp. '+kembaliconv+'</b>');
        $('#proses').attr('class', 'waves-effect waves-light btn-large');
      }else if( bayar < kirimbiaya){
        $('#pesan').html('<b class="red-text">Uang kurang</b>');
        $('#proses').attr('class', 'waves-effect waves-light btn-large disabled');
      }else if( bayar == kirimbiaya ){
        $('#pesan').html('<b class="light-green-text text-accent-4">Uang pas</b>');
        $('#proses').attr('class', 'waves-effect waves-light btn-large');
      }
    })
  })
})


//hapus pesan warning
$('#bayartunai').focusout(function(){
  $('#pesan').fadeOut(1000);

//  $('#proses').attr('class', 'waves-effect waves-light btn-large disabled');
})

$('#proses').click(function(){
  var nama = $('#membernama').text();
  var kategori = $('#kategori').text();
  var transvalue = $('select[name="jtrans"] :selected').attr('class');
  var transvalue2 = $('select[name="jtrans"] :selected').text();
  var modal = 'Member <b>'+nama+'</b> terdaftar sebagai member <b>'+kategori+'</b>. Silahkan pilih salah satu transaksi yang sesuai dengan kategori <b>'+kategori+'</b> atau buat member baru.'
  var modal2 = 'Member <b>'+nama+'</b> sudah terdaftar sebagai member <b>'+kategori+'</b>. Silahkan pilih transaksi perpanjang atau harian.'
  var modal3 = 'Member <b>'+nama+'</b> belum terdaftar sebagai member <b>'+kategori+'</b>. Silahkan pilih transaksi daftar bulanan atau harian.'
  var expired = $('#expdate').text();
  if( !(kategori == transvalue) ){
    $('.modal').modal();
    $('.modal').modal('open');
    $('#isimodal').html(modal);
    $('#proses').attr('class', 'waves-effect waves-light btn-large disabled');
    $('#bayartunai').val('');
  }else if(!(expired == '') && /daftar/i.test(transvalue2)){
    $('.modal').modal();
    $('.modal').modal('open');
    $('#isimodal').html(modal2);
  }else if( expired == '' && /perpanjang/i.test(transvalue2)){
    $('.modal').modal();
    $('.modal').modal('open');
    $('#isimodal').html(modal3);
  }else{
    $('form').submit();
  }
})



</script>
@endsection
