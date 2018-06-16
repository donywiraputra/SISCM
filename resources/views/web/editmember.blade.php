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
    <li><a class="waves-effect black-text" href="/datatransaksi">Data transaksi</a></li>
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="/datamember">Data member</a></li>
    <li><a class="waves-effect black-text" href="databarang">Data barang</a></li>
    <li><a class="sidenav-close hide-on-large-only">Tutup</a></li>
  </ul>
@endsection
@section ('content')
<div class="container">
  <div class="row">
    <h4 class="center-align">Edit Member</h4>
  </div>
</div>
<div class="divider"></div>
<div class="container">
<br>

<div class="row">
  <div class="col s12">
    <h5><b id="mbrtitle">{{$memberview->namamember}}</b></h5>
<br>
    <form action="/datamember/{{$memberview->idmember}}" method="post">
      <input name="_method" type="hidden" value="PUT">

      <div class="row">
        <div class="input-field col s12 m6 l6">
          <select name="katagorimember" disabled>
            <option disabled selected>{{ $memberview->katmember }}</option>
            @foreach ($katagori as $kmember)
              <option value="{{ $kmember->idkatmember }}"> {{ $kmember->katmember }} </option>
            @endforeach
          </select>
          <label>Kategori member</label>
          @if($errors->has('katagorimember'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>

        <div class="input-field col s12 m6 l6">
          <input name="namambredit" id="namamem" type="text" value="{{ $memberview->namamember }}" autocomplete="off">
          <label for="namambr">Nama member</label>
          <div id="pesannama"></div>
          @if($errors->has('namambredit'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6 l6">
          <input name="namalengkap" type="text" value="{{ $memberview->namalengkap }}" autocomplete="off">
          <label for="namalengkap">Nama lengkap</label>
          @if($errors->has('namalengkap'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>

        <div class="input-field col s12 m6 l6">
          <select name="jeniskelamin">
            <option value="{{ $memberview->jnskelamin }}" selected>{{$memberview->kelamin}}</option>
            @foreach ($kelamins as $jnskelamin)
              <option value="{{ $jnskelamin->idkelamin }}"> {{ $jnskelamin->kelamin }} </option>
            @endforeach
          </select>
          <label>Jenis kelamin</label>
          @if($errors->has('jeniskelamin'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6 l6">
          <input name="alamat" type="text" value="{{ $memberview->alamat }}" autocomplete="off">
          <label for="alamat">Alamat</label>
          @if($errors->has('alamat'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>

        <div class="input-field col s12 m6 l6">
          <input name="notelp" type="text" value="{{ $memberview->notelp }}" autocomplete="off">
          <label for="notelp">Nomor telepon</label>
          @if($errors->has('notelp'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6 l6">
          <input name="tgllahir" type="text" class="datepicker" value="{{ $memberview->tgl_lahir }}" autocomplete="off">
          <label for="tgllahir">Tanggal lahir</label>
          @if($errors->has('tgllahir'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>
      </div>

      <div class="row">
      @if ($message = Session::get('success'))
        <p class="sukses left light-green-text text-accent-4"><b>{{$message}}</b></p>
      @endif
        <div class="col s12 m6 l6">
          <a href="/datamember" class="waves-effect waves-light btn-large">Batal</a>
          &nbsp
          <button class="waves-effect waves-light btn-large" type="submit">Simpan</button>
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
</div>
@endsection

@section('script')
  <script>
    $('*').click(function(){
      $('p.alert').hide();
      $('p.sukses').fadeOut(3000);
    });

    $('#namamem').change(function(){
      var name = $('#namamem').val();
      var title = $('#mbrtitle').text();
      if(name === title){
        return false;
      }else{
      $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        method: "POST",
        url: "/validasinamambr",
        data: {input: name}
      }).done(function(datanama){
      //  alert(datanama);
        var data = datanama;
        var x = "gagal";
        var y = "sukses";

        if(data === x)
        {
          var clr = $('#namamem').val("{{ $memberview->namamember }}");
          M.toast({html: 'Maaf, nama sudah digunakan. Silahkan gunakan nama lain.', classes: 'rounded'})+clr;
        }
      })
    }
    })
  </script>
@endsection
