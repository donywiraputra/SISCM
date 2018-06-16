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
    <li><a class="waves-effect black-text" href="transaksidagang">Transaksi dagang</a></li>
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="/datatransaksi">Data transaksi</a></li>
    <li><a class="waves-effect black-text" href="/datamember">Data member</a></li>
    <li><a class="waves-effect black-text" href="databarang">Data barang</a></li>
    <li><a class="sidenav-close hide-on-large-only">Tutup</a></li>
  </ul>
@endsection

@section('content')
<div class="container">
<div class="row">
  <h4 class="center-align">Edit Transaksi</h4>
</div>
</div>
<div class="divider"></div>
<div class="container">
<br>
<div class="row">
  <h5>Data yang ingin diubah :</h5>
</div>
<div class="col s12 m6 l6">

  <form action="/datatransaksi/id{{$trans->idtransaksi}}" method="post">
    <input name="_method" type="hidden" value="PUT">
    <div class="row">
      <div class="input-field col s12 m6 l6">
        <input name="namambr" type="text" value="{{ $trans->namamember }}" id="autocomplete-input" class="autocomplete" autocomplete="off">
        <label for="autocomplete-input">Ganti nama member</label>
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
          <option class="default" value="{{ $trans->idjnstransaksi }}" selected>{{ $trans->namatransaksi }}</option>
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
        </select>
        <label>Ganti jenis transaksi</label>
      </div>
    </div>

    <div class="row">
      <div class="col s12 m6 l6">
      <a href="/datatransaksi" id="cancel" class="waves-effect waves-light btn-large">Batal</a>&nbsp;
      <a id="proses" class="waves-effect waves-light btn-large">Simpan</a>
    </div>
    </div>
    {{ csrf_field() }}
  </form>
  </div>

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
  $('#autocomplete-input').ready(function(){
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
            var collection6 = '<li class="collection-item">Expired: <b class="right">'+datamember.expired_date+'</b></li></ul>';
            if ( exp === null){
              $('.data').append(collection1+collection2+collection3+collection4+collection5);
            }else{
              $('.data').append(collection1+collection2+collection3+collection4+collection5+collection6);
            }
            $('#pesan').empty();
          }
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
                var collection6 = '<li class="collection-item">Expired: <b class="right">'+datamember.expired_date+'</b></li></ul>';
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
    var modal = 'Member <b>'+nama+'</b> terdaftar sebagai member <b>'+kategori+'</b>. Silahkan pilih salah satu transaksi yang sesuai dengan kategori <b>'+kategori+'</b> atau buat member baru.'
    if( kategori == ''){
      $('#alert').text("Nama masih kosong!");

    }else if( !(kategori == transvalue) ){
      $('.modal').modal();
      $('.modal').modal('open');
      $('#isimodal').html(modal);
    }
  })
})


$('#proses').click(function(){
  var nama = $('#membernama').text();
  var kategori = $('#kategori').text();
  var transvalue = $('select[name="jtrans"] :selected').attr('class');
  var transdef = $('select[name="jtrans"] :selected').val();
  var modal = 'Member <b>'+nama+'</b> terdaftar sebagai member <b>'+kategori+'</b>. Silahkan pilih salah satu transaksi yang sesuai dengan kategori <b>'+kategori+'</b> atau buat member baru.'

  if( transvalue == 'default' || kategori === transvalue ){
    $('form').submit();
  }
  else if( !(kategori === transvalue) ){
    $('.modal').modal();
    $('.modal').modal('open');
    $('#isimodal').html(modal);
    $('#bayartunai').val('');
  }
})



</script>
@endsection
