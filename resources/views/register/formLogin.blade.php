<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <style>
        #errorbutton{
          color: black;
        }
      </style>
    </head>
    <body>
      <div class="container">
        <br>
        <div class="row">
          <div class="col s12 m8 offset-m2">
            <div class="card">
            <div class="card-content grey darken-2">
              <h3 class="center white-text"><i class="medium material-icons">lock_open</i> Login User</h3>
            </div>

              <div class="card-content grey lighten-5">
                <form action="{{url(action('LoginController@postLogin'))}}" method="post">
                  <div class="row">

                    <div class="input-field">
                      <input name="nama" type="text" class="validate" autocomplete="off">
                      <label for="nama">Nama User</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field">
                      <input name="password" type="password" class="validate">
                      <label for="password">Password</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="right">
                      <button class="btn waves-effect waves-light btn-small grey darken-2" type="submit" name="action">Cancel<i class="material-icons right">cancel</i></button>
                      <button class="btn waves-effect waves-light btn-small grey darken-2" type="submit">Login<i class="material-icons right">send</i></button>
                    </div>
                  </div>
                  {{ csrf_field() }}
                </form>
              </div>
            </div>
          </div>
          @if ($message = Session::get('error'))
            <div class="col s12 m8 offset-m2">
              <div class="card-panel red lighten-3 center-align">

                <b> {{$message}} </b>
                <a href="{{url(action('LoginController@getLogin'))}}" id="errorbutton"><i class="material-icons right">cancel</i></a>
              </div>
            </div>
          @endif
        </div>
      </div>

      <!--JQuery & JavaScript at end of body for optimized loading-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
