<html>
    <head>
      <title>scm</title>
      <!--Import Google Icon Font-->
      <link href="{{ asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <style>
      header, main, footer {
        padding-left: 300px;
      }

      @media only screen and (max-width : 992px) {
      header, main, footer {
        padding-left: 0;
        }
      }

      body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
      }

      main {
        flex: 1 0 auto;
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


            @yield('content')


        </main>
      <footer class="page-footer white" style="border-top: 2px solid #e0e0e0;">
        <div class="center grey-text" style="padding-bottom: 1em;">
          © 2018 Copyright Text
        </div>
      </footer>

      <!--JavaScript at end of body for optimized loading-->
      <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
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
      @yield('script')

    </body>
</html>
