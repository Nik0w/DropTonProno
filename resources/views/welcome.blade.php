@extends('layouts.app')

@section('content')

<div class="container-fluid header-welcome">
    <div class="col-12 text-center">
        <a href="{{url('/')}}"><img src="{{asset('img/logo.png')}}" alt=""></a>
    </div>
</div>


<div class="container">

    <div class="row welcome">
        <div class=".d-none .d-sm-block col-md-8 encartPub"></div>

        <div class="col-12 text-center">
            <h1>Rejoins nous sur le premier site de pronostics gratuits dédié au rugby, essaye de grimper au classement pour gagner des lots !</h1>
        </div>

        <div class="col-12 text-center zone-cta">
            <a class="cta bg-orange" href="{{ url('/register') }}">Je m'inscris ></a>
            <a class="cta bg-bleu" href="{{ url('/login') }}">Je me connecte ></a>
        </div>

    </div>
</div>
<div class="container-fuid">
    
    <div class="bg-img">

        <div class="container container-home">
            <div class="row">
                <div class="col-4 text-center">1</div>
                <div class="col-4 text-center">2</div>
                <div class="col-4 text-center">3</div>
            </div>
        </div>
        

    </div>

</div>

    
</div>
@endsection