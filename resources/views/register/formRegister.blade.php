<!DOCTYPE html>
  <html>
    <head>
      <title>
        SISCM - Register
      </title>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Register user</title>
    </head>
    <body>
      <div class="container">
        <br>
        <div class="row">
          <div class="col s12 m8 offset-m2">
            <div class="card">
            <div class="card-content">
              <span class="card-title"><b>Register User</b></span>
              <div class="divider"></div>
              <br>
                <form action="{{url(action('RegisterController@postRegister'))}}" method="post">


                    <div class="input-field">
                      <input name="nama" type="text" class="validate" value="{{ old('nama' )}}" autocomplete="off">
                      <label for="nama">Nama User</label>
                    </div>
                    <div>
                      @if($errors->has('nama'))
                        <p class="alert red-text">{{ $errors->first('nama') }}</p>
                      @endif
                    </div>



                    <div class="input-field">
                      <input name="namalengkap" type="text" class="validate" value="{{ old('namalengkap' )}}" autocomplete="off">
                      <label for="namalengkap">Nama lengkap</label>
                    </div>
                    <div>
                      @if($errors->has('namalengkap'))
                        <p class="alert red-text">{{ $errors->first('namalengkap') }}</p>
                      @endif
                    </div>

                    <div class="input-field">
                      <select name="userlevel" value="{{ old('userlevel' )}}">
                          <option value="" disabled selected>Pilih level user</option>
                          <option value="1">Admin</option>
                          <option value="2">User</option>
                      </select>
                      <label>User level</label>
                    </div>
                    <div>
                      @if($errors->has('userlevel'))
                        <p class="alert red-text">{{ $errors->first('userlevel') }}</p>
                      @endif
                    </div>



                    <div class="input-field">
                      <input name="password" type="password" class="validate" value="{{ old('password' )}}">
                      <label for="password">Password</label>
                    </div>
                    <div>
                      @if($errors->has('password'))
                        <p class="alert red-text">{{ $errors->first('password') }}</p>
                      @endif
                    </div>

                    <div class="input-field">
                      <input name="repassword" type="password" class="validate">
                      <label for="password">Ulangi password</label>
                    </div>
                    <div>
                      @if($errors->has('repassword'))
                        <p class="alert red-text">{{ $errors->first('repassword') }}</p>
                      @endif
                    </div>
                  </div>

                  <div class="card-action">
                    @if ($message = Session::get('success'))
                      <p class="sukses left light-green-text text-accent-4"><b>{{$message}}</b></p>
                    @endif

                      <a href="/" class="btn waves-effect waves-light btn-small grey darken-2">Kembali</a>
                      <button class="btn waves-effect waves-light btn-small grey darken-2" type="submit">Register</button>

                  </div>
                  {{ csrf_field() }}
                </form>

            </div>
          </div>
        </div>
      </div>

      <!--JQuery & JavaScript at end of body for optimized loading-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
      $(document).ready(function(){
        $('select').formSelect();
        $('*').click(function(){
          $('.alert').fadeOut(1000);
          $('.sukses').fadeOut(1000);
        })
      });
      </script>
    </body>
  </html>
