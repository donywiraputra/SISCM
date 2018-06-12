<!DOCTYPE html>
  <html>
    <head>
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
          <div class="col s12 m8 offset-m2">
            <div class="card">
            <div class="card-content grey darken-2">
              <h3 class="center white-text"><i class="medium material-icons">person_add</i> Register User</h3>
            </div>

              <div class="card-content grey lighten-5">

                <form action="{{url(action('RegisterController@postRegister'))}}" method="post">

                  <div class="row">
                    <div class="input-field">
                      <input name="nama" type="text" class="validate">
                      <label for="nama">Nama User</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="input-field">
                      <input name="namalengkap" type="text" class="validate">
                      <label for="namalengkap">Nama lengkap</label>
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
                      <a href="/" class="btn waves-effect waves-red btn-small transparent grey-text">Cancel<i class="material-icons right">cancel</i></a>
                      <button class="btn waves-effect waves-light btn-small grey darken-2" type="submit">Register<i class="material-icons right">send</i></button>
                    </div>
                  </div>
                  {{ csrf_field() }}
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--JQuery & JavaScript at end of body for optimized loading-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
  </html>
