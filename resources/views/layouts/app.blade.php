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
                <a class="nav-link" href="{{url('/')}}"><img class="img-fluid" src="{{ asset('img/logo.png') }}"></a>
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
                                <a class="nav-link" href="{{url('/reglement')}}">Reglement</a>
                            </div>
                          </li>
                          <li class="nav-item col-md-8 d-none d-md-block">
                            <div class="logo text-center">
                                <a class="nav-link" href="{{url('/')}}"><img class="img-fluid" src="{{ asset('img/logo.png') }}"></a>
                            </div>
                            
                          </li>
                          <li class="nav-item text-right col-12 col-md-2">
                            <div class="classement"><a href="{{url('/classement')}}">Classement</a></div>
                            <div class="vestiaire"><a href="{{url('/vestiaire')}}">Vestiaire</a></div>
                          </li>
                        </ul>
                    </div>
                </div>
              </div>
        </nav>
    </div>

  </div>

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
