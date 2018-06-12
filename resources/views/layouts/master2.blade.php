<html>
    <head>
      <title>scm</title>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <style>
      header, main, footer {
        padding-left: 300px;
      }

      @media only screen and (max-width : 992px) {
      header, main, footer {
        padding-left: 0;
        }
      }

      #indent{
        padding-left :32px;
        padding-right: 32px;
      }

      #sidenavbtn{
        color: grey;
      }

      #kategoribtn{
        display: inline;
      }

      </style>
    </head>

    <body>
      <header>
        @yield('header')

      </header>
      <main>
        <div class="container">
          @yield('content')
        </div>
      </main>
      <footer class="page-footer blue lighten-5">
        <div class="container">

        </div>
      </footer>

      <!--JavaScript at end of body for optimized loading-->

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script>
      $(document).ready(function(){
        $('.sidenav').sidenav();
        $('.collapsible').collapsible();
        $('.datepicker').datepicker({
          yearRange: 70,
          format: 'yyyy-mm-dd'
        });
        $('select').formSelect();


      });
      </script>

    
    </body>
</html>
  </html>
