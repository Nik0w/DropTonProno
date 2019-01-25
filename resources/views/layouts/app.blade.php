<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Drop Ton Prono - Le site de pronostics rugby en ligne 100% gratuit</title>
    <meta name="description" content="Le site de pronostics sportifs dédié au rugby 100% gratuit ! Venez gagner des cadeaux et participer aux pronostics du Top 14">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/')}}apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('/')}}apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/')}}apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/')}}apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/')}}apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/')}}apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/')}}apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/')}}apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/')}}apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('/')}}android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/')}}favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/')}}favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}favicon-16x16.png">
        <link rel="manifest" href="manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.js"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    @if(Request::is('resultats/*'))
    
      <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    	<script>
    	  (adsbygoogle = window.adsbygoogle || []).push({
    	    google_ad_client: "ca-pub-2321115655760938",
    	    enable_page_level_ads: true
    	  });
    	</script>
  @endif
</head>
<body>

   <div id="app">
    
     @yield('content')

     <div class="container-fluid footer text-center">

      <h2>Nos partenaires :</h2>

        <div id="partenairesCarousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block margAuto" src="{{asset('img/partenaires/berugbe.png')}}" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block margAuto" src="{{asset('img/partenaires/rugbyshop.png')}}" alt="First slide">
            </div>
          </div>
          <a class="carousel-control-prev no-loader" href="#partenairesCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next no-loader" href="#partenairesCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="socials">
          <a class="no-loader" href="https://www.facebook.com/droptonprono/" target="blank"><img src="{{asset('img/fb.png')}}" alt=""></a>
          <a class="no-loader" href="https://www.instagram.com/droptonprono/" target="blank"><img src="{{asset('img/insta.png')}}" alt=""></a>
          <a class="no-loader" href="https://twitter.com/Droptonprono" target="blank"><img src="{{asset('img/twitter.png')}}" alt=""></a>
        </div>

        <p>&copy; Drop Ton Prono 2018 - <a href="{{url('/cgu')}}">CGU</a></p>
        <div class="text-center"><a class="no-loader" href="mailto:contact@droptonprono.fr">Contactez-nous</a></div>
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

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-122977680-1','auto');ga('send','pageview');
    </script>
</body>
</html>
