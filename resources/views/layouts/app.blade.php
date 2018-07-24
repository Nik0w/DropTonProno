<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>

   <div id="app">

    <div class="container-fluid no-padding">

        <nav class="navbar navbar-expand-lg navbar-light">
            
            <div class="logo text-center d-block d-md-none">
                <a class="nav-link" href="#"><img class="img-fluid" src="{{ asset('img/logo.png') }}"></a>
            </div>
    
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="container-fluid">
                    <div class="row">
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 col-12">
                          <li class="nav-item active col-12 col-md-2">
                            <div class="reglement">
                                <a class="nav-link" href="#">Reglement</a>
                            </div>
                          </li>
                          <li class="nav-item col-md-8 d-none d-md-block">
                            <div class="logo text-center">
                                <a class="nav-link" href="#"><img class="img-fluid" src="{{ asset('img/logo.png') }}"></a>
                            </div>
                            
                          </li>
                          <li class="nav-item text-right col-12 col-md-2">
                            <div class="classement"><a href="#">Classement</a></div>
                            <div class="vestiaire"><a href="#">Vestiaire</a></div>
                          </li>
                        </ul>
                    </div>
                </div>
              </div>
        </nav>
    </div>


    

   
    <!--<div class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <header>   

            <div class="col-2 col-md-2 reglement"><a href="#">Reglement</a></div>
            <div class="col-8 col-md-8 logo text-center">
                <a href="#"><img class="img-fluid" src="{{ asset('img/logo.png') }}"></a>
            </div>
            <div class="col-2 col-md-2 text-right">
            <div class="classement"><a href="#">Classement</a></div>
            <div class="vestiaire"><a href="#">Vestiaire</a></div>
            </div>

    </header>
      </div>

     </div>

     </nav>


        <!--<nav class="navbar navbar-default navbar-static-top">
            <div class="container">

                <div class="navbar-header">

                     Collapsed Hamburger 
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>



                     Branding Image 
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                     Left Side Of Navbar 
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    Right Side Of Navbar 
                    <ul class="nav navbar-nav navbar-right">
                         Authentication Links 
                        @if (Auth::guest())
                            
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div> -->
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}"></script>
     <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
