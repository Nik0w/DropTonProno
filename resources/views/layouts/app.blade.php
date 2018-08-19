<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
        <link rel={{asset('/')}}"apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
        <link rel={{asset('/')}}"apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
        <link rel={{asset('/')}}"apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
        <link rel={{asset('/')}}"apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
        <link rel={{asset('/')}}"apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
        <link rel={{asset('/')}}"apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
        <link rel={{asset('/')}}"apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
        <link rel={{asset('/')}}"apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
        <link rel={{asset('/')}}"icon" type="image/png" sizes="192x192"  href="android-icon-192x192.png">
        <link rel={{asset('/')}}"icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel={{asset('/')}}"icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
        <link rel={{asset('/')}}"icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel={{asset('/')}}"manifest" href="manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>

   <div id="app">
    
     @yield('content')

     <div class="container-fluid footer text-center">
        <div class="socials">
          <a href="https://www.facebook.com/droptonprono/" target="blank"><img src="{{asset('img/fb.png')}}" alt=""></a>
          <a href="https://www.instagram.com/droptonprono/" target="blank"><img src="{{asset('img/insta.png')}}" alt=""></a>
          <a href="https://twitter.com/Droptonprono" target="blank"><img src="{{asset('img/twitter.png')}}" alt=""></a>
        </div>

        <p>&copy; Drop Ton Prono 2018 - <a href="{{url('/cgu')}}">CGU</a></p>
        <div class="text-center"><a href="mailto:contact@droptonprono.fr">Contactez-nous</a></div>
     </div>
   </div>

    <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}"></script>
     <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
