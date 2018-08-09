@extends('layouts.app')

@section('content')

<div class="container-fluid header-welcome">
    <div class="col-12 text-center">
        <a href="{{url('/')}}"><img class="img-fluid" src="{{asset('img/logo.png')}}" alt=""></a>
    </div>
</div>


<div class="container">

    <div class="row welcome">
        <div class=".d-none .d-sm-block col-md-8 encartPub"></div>

        <div class="col-12 col-md-8 offset-md-2 text-center lato">
            <h1>Rejoins nous sur le premier site de pronostics gratuits dédié au rugby, essaye de grimper au classement pour gagner des lots !</h1>
        </div>

        <div class="col-12 col-sm-8 offset-sm-2 text-center zone-cta">
            <div class="row">
                <div class="col-12 col-md-6">
                    <a class="cta bg-orange" href="{{ url('/register') }}">Je m'inscris ></a>
                </div>
                <div class="col-12 col-md-6">
                    <a class="cta bg-bleu" href="{{ url('/login') }}">Je me connecte ></a>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container-fuid">
    
    <div class="bg-img">

        <div class="container container-home">
            <div class="row">
                <div class="col-12 col-md-4 text-center"><img class="img-fluid" src="{{asset('img/welcome-01.png')}}"></div>
                <div class="col-12 col-md-4 text-center"><img class="img-fluid" src="{{asset('img/welcome-02.png')}}"></div>
                <div class="col-12 col-md-4 text-center"><img class="img-fluid" src="{{asset('img/welcome-03.png')}}"></div>
            </div>
        </div>
        

    </div>

</div>

    
</div>
@endsection