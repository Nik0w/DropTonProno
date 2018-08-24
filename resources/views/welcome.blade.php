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

        <div class="col-12 col-md-8 offset-md-2 text-center">
            <h1 class="title-welcome">Rejoins-nous sur le premier site de pronostics gratuits dédié au rugby et au Top 14 !</h1>
        </div>

        <div class="col-12 col-sm-8 offset-sm-2 text-center zone-cta">
            <div class="row">
                @if(Auth::check())
                <div class="col-12 text-center">
                    <a class="cta bg-orange" href="{{ url('/resultats/1') }}">Voir les pronostics !</a>
                </div>
                @else
                <div class="col-12 col-md-6">
                    <a class="cta bg-orange" href="{{ url('/register') }}">Je m'inscris <div><i class="fas fa-long-arrow-alt-right"></i></div></a>
                </div>
                <div class="col-12 col-md-6">
                    <a class="cta bg-bleu" href="{{ url('/login') }}">Je me connecte <div><i class="fas fa-long-arrow-alt-right"></i></div></a>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>
<div class="container-fuid">
    
    <div class="bg-img">

        <div class="container container-home color-blue">
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3 text-center infos">
                    <div><img src="{{asset('img/Ballon-rugby.png')}}" alt=""></div>
                    <h2 class="hansief">1<sup>er</sup> site de pronostics dédié au rugby</h2>
                    <h3>Moins cher que la 3<sup>ème</sup> mi-temps, c'est <b>gratuit !</b></h3>
                </div>

                <div class="col-12 col-sm-6 col-md-3 text-center infos">
                    <div><img src="{{asset('img/picto-prono.png')}}" alt=""></div>
                    <h2 class="hansief">Fais tes pronostics</h2>
                    <h3>Résultats, scores, nombres d'essais, joue-la comme Wilko et tente le drop <b>gagnant !</b></h3>
                </div>

                <div class="col-12 col-sm-6 col-md-3 text-center infos">
                    <div><img src="{{asset('img/picto-coupe.png')}}" alt=""></div>
                    <h2 class="hansief">Grimpe au classement</h2>
                    <h3>Cumule tes points après chaque journée du <b>Top 14</b>... Attention à la relégation !</h3>
                </div>

                <div class="col-12 col-sm-6 col-md-3 text-center infos">
                    <div><img src="{{asset('img/picto-maillot.png')}}" alt=""></div>
                    <h2 class="hansief">Gagne des lots !</h2>
                    <h3>Un <b>gagnant</b> par mois, et un classement à l'année pour les plus entraînés !</h3>
                </div>

                

            </div>
        </div>
        

    </div>

</div>

    
</div>
@endsection