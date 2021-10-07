<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link href="/maindir/css/bootstrap.min.css" rel="stylesheet">
    <link href="/maindir/css/nav.css" rel="stylesheet">
    <link href="/maindir/css/main.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/f5727dd66415af47582ddb87de6e9f81?family=Quebec-Serial+DB" rel="stylesheet" type="text/css"/>

    {{-- <!-- Scripts -->
    <script src="/maindir/js/app.js" defer></script>
  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/maindir/css/app.css" rel="stylesheet">
    <link href="/maindir/css/bootstrap.min.css" rel="stylesheet">
    <link href="/maindir/css/mainstyle.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> --}}
</head>
<body>

    <div id="app">

    <div id="mySidenav" class="sidenav">
        {{-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> --}}
        <a href="#" class="xbtn" onclick="closeNav()">&times;</a>
        <a href="#">ABOUT</a>
        <a href="#">SERVICES</a>
        <a href="#">ACCOUNT SETUP <i class="fa fa-gear pull-right">&nbsp;&nbsp;</i></a>

        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                {{-- <li class="nav-item"> --}}
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }} <i class="fa fa-user-circle pull-right">&nbsp;&nbsp;</i></a>
                {{-- </li> --}}
            @endif

            @if (Route::has('register'))
                {{-- <li class="nav-item"> --}}
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }} <i class="fa fa-address-card pull-right">&nbsp;&nbsp;</i></a>
                {{-- </li> --}}
            @endif
        @else
            
                {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a> --}}

                @if (Auth::user()->user_type != 'useruser')
                    {{-- <li class="nav-item"> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            <i class="fa fa-user-circle pull-right">&nbsp;&nbsp;</i>
                        </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    {{-- </li> --}}
                @endif
            
        @endguest
        
        <p class="my_footer_txt">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
            <br><a href="#" target="_blank">PivoApps <img src="maindir/my_images/pivo.png" width="40" class="pivo" /></a>
    </div>
      
    <div class="nav1">
        <p><button class="ic_left"><i id="nav_open_icon" class="fa fa-th-large" onclick="openNav()"></i></button>Ri<b>PREDICT</b><button class="ic_right"><i class="fa fa-bell-o"></i></button></p>
    </div>
    @yield('nav2')

    <div class="shape1">
    </div>

    <div class="shape2">
    </div>

    @yield('content')

    <script>
        function openNav() {
          document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("nav_open_icon").style.opacity = 0;
        }
        
        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
          document.getElementById("nav_open_icon").style.opacity = 1;
        }
    </script>

    </div>
</body>
</html>
