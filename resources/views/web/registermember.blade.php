style="padding-left: 45px;" @extends('layouts.master')
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
    <li class="active cyan lighten-5"><a class="waves-effect black-text" href="regmember">Register member</a></li>
    <li><a class="waves-effect black-text" href="transmember">Transaksi member</a></li>
    <li><a class="waves-effect black-text" href="transaksidagang">Transaksi dagang</a></li>
    <ul class="collapsible">
    <li>
      <div class="collapsible-header" style="padding-left: 32px; font-size: 14px;
    font-weight: 500;">Master data</div>
      <div class="collapsible-body">
        <ul>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="datatransaksi">Data transaksi member</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="datatransdagang">Data transaksi dagang</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="datamember">Data member</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="databarang">Data barang</a></li>
          <li><a class="waves-effect black-text" style="padding-left: 45px;" href="pengeluaran">Data pengeluaran</a></li>
        </ul>
      </div>
    </li>
  </ul>
    <li><a class="waves-effect black-text" href="laporan">Laporan</a></li>
    <li><a class="sidenav-close hide-on-large-only">Tutup</a></li>
  </ul>
@endsection
@section ('content')
<div class="container">
  <div class="row">
  <h4 class="center-align">Registrasi Member</h4>
  </div>
</div>
<div class="divider"></div>
<div class="container">
<br><br>
<div class="row">

  <div class="col s12">
    <form action="{{url(action('MemberController@createMember'))}}" method="post">

      <div class="row">
        <div class="input-field col s12 m6 l6">
          <select name="katagorimember">
            <option disabled selected>Pilih kategori member</option>
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
          <input name="namambr" id="namamem" type="text" class="validate" value="{{ old('namambr' )}}" autocomplete="off">
          <label for="namambr">Nama member</label>
          <div id="pesannama"></div>
          @if($errors->has('namambr'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6 l6">
          <input name="namalengkap" type="text" class="validate" value="{{ old('namalengkap' )}}" autocomplete="off">
          <label for="namalengkap">Nama lengkap</label>
          @if($errors->has('namalengkap'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>

        <div class="input-field col s12 m6 l6">
          <select name="jeniskelamin">
            <option value="{{ old('jeniskelamin' )}}" disabled selected>Pilih jenis kelamin</option>
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
          <input name="alamat" type="text" class="validate" value="{{ old('alamat' )}}" autocomplete="off">
          <label for="alamat">Alamat</label>
          @if($errors->has('alamat'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>

        <div class="input-field col s12 m6 l6">
          <input name="notelp" type="text" class="validate" value="{{ old('notelp' )}}" autocomplete="off">
          <label for="notelp">Nomor telepon</label>
          @if($errors->has('notelp'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6 l6">
          <input name="tgllahir" type="text" class="datepicker" value="{{ old('tgllahir' )}}" autocomplete="off">
          <label for="tgllahir">Tanggal lahir</label>
          @if($errors->has('tgllahir'))
            <p class="alert red-text">Harus diisi!</p>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="col s12 m6 l6">
          <a href="/" class="waves-effect waves-light btn-large">Batal</a>
          &nbsp
          <button class="waves-effect waves-light btn-large" type="submit">Lanjut</button>
        </div>
        @if ($message = Session::get('success'))
          <p class="sukses left light-green-text text-accent-4"><b>{{$message}}</b></p>
        @endif
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
        if(data==y)
        {
          $('#pesannama').val("");
        }else if(data === x)
        {
          var clr = $('#namamem').val("");
          M.toast({html: 'Maaf, nama sudah digunakan. Silahkan gunakan nama lain.', classes: 'rounded'})+clr;
        }
      })
    })
  </script>
@endsection
