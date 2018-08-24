<!DOCTYPE html>
  <html>
    <head>
      <title>
        SISCM - Login
      </title>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    </head>
    <body>
      <div class="container">
        <br>
        <div class="row">
          <div style="margin: auto; width: 350px;">
            <div class="card">

              <div class="card-content">
                <span class="card-title"><b>Login User</b></span>
                <br>
                <form action="{{url(action('LoginController@postLogin'))}}" method="post">

                    <div class="input-field">
                      <input name="nama" type="text" class="validate" autocomplete="off">
                      <label for="nama">Nama User</label>
                    </div>

                    <div class="input-field">
                      <input name="password" type="password" class="validate">
                      <label for="password">Password</label>
                    </div>
              </div>

                    <div class="card-action">
                        <button class="btn waves-effect waves-light btn-small grey darken-2" type="submit">Login</button>
                    </div>

              {{ csrf_field() }}
            </form>
        </div>
        @if ($message = Session::get('error'))
              <p class="alert red-text">{{$message}}</p>
        @endif
      </div>
      </div>
      </div>

      <!--JQuery & JavaScript at end of body for optimized loading-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
        $('*').click(function(){
          $('.alert').fadeOut(1000);
        })
      </script>
    </body>
  </html>
