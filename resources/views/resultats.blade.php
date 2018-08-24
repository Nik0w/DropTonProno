@extends('layouts.app')

@section('content')

<div class="bg-img">

    @include('includes.menu')

    @include('includes.reglement')

    <div class="nuages">
            <img class="nuage" src="{{asset('/img/nuages1.png')}}" alt="">
            <img class="nuage" src="{{asset('/img/nuages2.png')}}" alt="">
            <img class="nuage" src="{{asset('/img/nuages3.png')}}" alt="">
    </div>


    <div class="container">

        <div class="row" id="notificationsZone">
            @if(session()->has('success'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible show" role="alert">
                  <strong>Félicitation ! </strong>{{\Session::get('success')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            @endif
            @if(session()->has('error'))
            <div class="col-12">
                <div class="alert alert-alert alert-dismissible show" role="alert">
                  <strong>Erreur ! </strong>{{\Session::get('error')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            </div>
            @endif
        </div>
        
        <div class="row resultats">
            <div class=".d-none .d-sm-block col-md-8 encartPub"></div>

            <div class="col-12 col-md-8 offset-md-2 text-resultats color-blue">
                <h1>Vos pronostics</h1>
                <p>Face aux perches, drop tes pronostics sur chaque rencontre du Top14 et tente de gagner des cadeaux,<br /> c’est gratuit ! <br />
                Modifie tes pronos jusqu’à la dernière minute et profite de ta 3ème mi-temps pour chambrer tes amis. <br />
                Et comme dirait un certain habitué...<i>Depuis le débuuut !</i>  <br />
                </p>
            </div>

        </div>

        @if(count($journees)>0)
        <div class="row journeesCarousel d-none d-md-block">
            <div class="col-12">

                <div id="journeeCarouselControls" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">

                    <div class="carousel-item active">
                      <div class="row">
                        @foreach($journees as $journee)
                            @if(url()->current() == route('resultats', $journee->id_journee))
                                <div class="col-2"><a class="active-journee" href="{{route('resultats', $journee->id_journee)}}">{{$journee->nom_journee}}</a></div>
                            @else
                                <div class="col-2"><a class="" href="{{route('resultats', $journee->id_journee)}}">{{$journee->nom_journee}}</a></div>
                            @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#journeeCarouselControls" role="button" data-slide="prev">
                    <i class="fas fa-arrow-left"></i>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#journeeCarouselControls" role="button" data-slide="next">
                    <i class="fas fa-arrow-right"></i>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
                
            </div>
        </div>
        <div class="row d-block d-md-none select_journee">
            <div class="col-12">
                <select class="d-block" name="journee" id="">
                    @foreach($journees as $journee)
                        @if(url()->current() == route('resultats', $journee->id_journee))
                            <option selected data-link="{{route('resultats', $journee->id_journee)}}" value="{{$journee->id_journee}}">{{$journee->nom_journee}}</option>
                        @else
                            <option data-link="{{route('resultats', $journee->id_journee)}}" value="{{$journee->id_journee}}">{{$journee->nom_journee}}</option> 
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        @endif

        @if(count($matchs)>0)
            @foreach($matchs as $match)

                <div class="tableau-res">
                    <div class="row justify-content-center">
                        <div class="col-4 col-md-2 text-center bg-white info-prono">

                            @if($match->date_debut_match > date("Y-m-d H:i:s"))
                                <span class="color-orange hansief">{{date_format(new DateTime($match->date_debut_match), 'd-m-Y')}} <i class="date_arrow fas fa-arrow-right"></i> {{date_format(new DateTime($match->date_debut_match), 'H:i')}}</span>
                            @elseif($match->date_debut_match <= date("Y-m-d H:i:s") && $match->date_fin_match >= date("Y-m-d H:i:s"))
                            <span class="hansief">Match en cours</span>
                            @else
                                <span class="hansief">Match fini</span>
                            @endif

                        </div>
                    </div>
                    <form action="" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="match" value="{{$match->id_match}}">
                        <div class="bg-white padding-top">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 col-md-9">
                                            <div class="row">
                                                <div class="col-6 logo-equipe padding-left">
                                                    <img src="{{ asset('img/equipes/'.$match->logo_equipe1) }}">
                                                </div>
                                                <div class="col-6 nom-equipe color-blue">
                                                    <div>
                                                        <h2>{{$match->nom_equipe1}}</h2>
                                                        <input type="hidden" name="id_equipe1" value="{{$match->id_equipe1}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 score-equipe-1">
                                            <div class="form-group">
                                                @if($match->date_debut_match > date("Y-m-d H:i:s"))
                                                    <input type="text" class="form-control" id="score_equipe1" name="score_equipe1" aria-describedby="score equipe 1" @if($match->points_equipe1 != null) placeholder="{{$match->points_equipe1}}"@else placeholder="--" @endif>
                                                @else
                                                    <input type="text" readonly class="form-control-plaintext score-input-disabled" id="" @if($match->points_equipe1 != null) placeholder="{{$match->points_equipe1}}"@else placeholder="--" @endif>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-12 col-md-9 col-sm-push-3">
                                            <div class="row">
                                                <div class="col-6 nom-equipe color-blue"><div><h2>{{$match->nom_equipe2}}</h2><input type="hidden" name="id_equipe2" value="{{$match->id_equipe2}}"></div></div>
                                                <div class="col-6 logo-equipe text-right padding-right">
                                                    <img src="{{ asset('img/equipes/'.$match->logo_equipe2) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3 col-sm-pull-9">
                                            <div class="form-group">
                                                 @if($match->date_debut_match > date("Y-m-d H:i:s"))
                                                <input type="text" class="form-control" id="score_equipe2" name="score_equipe2" aria-describedby="score equipe 1" @if($match->points_equipe2 != null) placeholder="{{$match->points_equipe2}}"@else placeholder="--" @endif>
                                                @else
                                                <input type="text" readonly class="form-control-plaintext score-input-disabled" id="staticEmail" @if($match->points_equipe2 != null) placeholder="{{$match->points_equipe2}}"@else placeholder="--" @endif>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-center nb-essai">
                                    Nombre d'essai dans le match :
                                    @if($match->date_debut_match > date("Y-m-d H:i:s"))
                                        <input type="text" name="score_essais" @if($match->nb_essai_prono != null) placeholder="{{$match->nb_essai_prono}}"@else placeholder="-" @endif>
                                    @else
                                        <input readonly type="text" name="score_essais" class="score-essai-disabled" @if($match->nb_essai_prono != null) placeholder="{{$match->nb_essai_prono}}"@else placeholder="-" @endif>
                                    @endif
                                </div>

                            </div>

                            <div class="essai-point lato">
                                <div class="row">
                                    <div class="col-4 col-md-12"><span>Resultat : </span>
                                        @if($match->date_debut_match < date("Y-m-d H:i:s"))
                                        {{$match->score_equipe1}} - {{$match->score_equipe2}}
                                        @else
                                        __-__
                                        @endif
                                    </div>
                                    <div class="col-4 col-md-12"><span>Essais : </span>@if($match->nb_essai_match != NULL){{$match->nb_essai_match}}@else-@endif</div>
                                    <div class="col-4 col-md-12 d-lg-none d-block">
                                        @if($match->date_debut_match > date("Y-m-d H:i:s"))
                                        <div class="point d-block d-lg-none grey-bg ">
                                            <p><span class="small-txt">Match pas encore joué</span></p>
                                        </div>
                                        @elseif($match->date_debut_match <= date("Y-m-d H:i:s") && $match->date_fin_match >= date("Y-m-d H:i:s"))
                                        <div class="point d-block d-lg-none">
                                            <p><span>Match en cours</p>
                                        </div>
                                        @else
                                        <div class="point-small d-block d-lg-none">
                                            <p>
                                                @if($match->nb_points != NULL)
                                                    <span>{{$match->nb_points}}</span> POINTS
                                                @else
                                                    @if($match->points_equipe1 == NULL && $match->points_equipe2 == NULL)
                                                        <span>0</span> POINTS
                                                    @else
                                                        <span>Calcul en cours</span>
                                                    @endif
                                                @endif
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($match->date_debut_match > date("Y-m-d H:i:s"))
                            <div class="point d-none d-lg-block bg-bleu point-noPoints">
                                <p><span class="small-txt">Match pas encore joué</span></p>
                            </div>
                            @elseif($match->date_debut_match <= date("Y-m-d H:i:s") && $match->date_fin_match >= date("Y-m-d H:i:s"))
                            <div class="point d-none d-lg-block grey-bg">
                                <p><span class="small-txt">Match en cours</span></p>
                            </div>
                            @else
                            <div class="point d-none d-lg-block bg-orange">
                                <p>
                                    @if($match->nb_points != NULL)
                                        <span>{{$match->nb_points}}</span><br />POINTS
                                    @else
                                        @if($match->points_equipe1 == NULL && $match->points_equipe2 == NULL)
                                            <span>0</span><br />POINTS
                                        @else
                                            <span>Calcul en cours</span>
                                        @endif
                                    @endif
                                </p>
                            </div>
                            @endif
                            

                        </div>

                        <div class="valid-prono">
                            <div class="row">
                                <div class="col-12 text-right">
                                    @if($match->date_debut_match < date("Y-m-d H:i:s"))

                                    @else
                                        <button class="cta bg-orange" type="submit">Je valide mon prono <div>></div></button>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

            @endforeach

        @else
            <div class="row">
                <div class="col-12 noMatches">
                    <p>Il n'y a pas encore de matchs disponibles... <br /> Mais revenez très vite pour lancer de nouveaux pronostics !</p>
                </div>
            </div>
        @endif
    </div>

</div>
@endsection
