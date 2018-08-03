@extends('layouts.app')

@section('content')

<div class="bg-img">

    @include('includes.menu')

    <div class="nuages">
            <img class="nuage" src="img/nuages1.png" alt="">
            <img class="nuage" src="img/nuages2.png" alt="">
            <img class="nuage" src="img/nuages3.png" alt="">
    </div>


    <div class="container">
        
        <div class="row resultats">
            <div class=".d-none .d-sm-block col-md-8 encartPub"></div>

            <div class="col-12">
                <p>Bienvenue à toi l'ami</p>
                <p>Viens faire tes pronos ! Victoire de l'UBB ? Défaite de Clermont ?</p>
                <p>Monte au classement pour gagner des >cadeaux</p>
            </div>

        </div>

        @foreach($matchs as $match)

            <div class="tableau-res">
                <form action="" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="match" value="{{$match->id_match}}">
                    <div class="bg-white padding-top">
                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 col-md-10">
                                        <div class="row">
                                            <div class="col-6 logo-equipe padding-left">
                                                <img src="{{ asset('img/equipes/'.$match->logo_equipe1) }}">
                                            </div>
                                            <div class="col-6 nom-equipe">
                                                <div>
                                                    <h2>{{$match->nom_equipe1}}</h2>
                                                    <input type="hidden" name="id_equipe1" value="{{$match->id_equipe1}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2 score-equipe-1">
                                        <div class="form-group">
                                            @if($match->date_debut_match > date("Y-m-d H:i:s"))
                                                <input type="text" class="form-control" id="score_equipe1" name="score_equipe1" aria-describedby="score equipe 1" @if($match->points_equipe1 != null) placeholder="{{$match->points_equipe1}}"@else placeholder="--" @endif>
                                            @else
                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" @if($match->points_equipe1 != null) placeholder="{{$match->points_equipe1}}"@else placeholder="--" @endif>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-12 col-sm-10 col-sm-push-2">
                                        <div class="row">
                                            <div class="col-6 nom-equipe"><div><h2>{{$match->nom_equipe2}}</h2><input type="hidden" name="id_equipe2" value="{{$match->id_equipe2}}"></div></div>
                                            <div class="col-6 logo-equipe text-right padding-right">
                                                <img src="{{ asset('img/equipes/'.$match->logo_equipe2) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-2 col-sm-pull-10">
                                        <div class="form-group">
                                             @if($match->date_debut_match > date("Y-m-d H:i:s"))
                                            <input type="text" class="form-control" id="score_equipe2" name="score_equipe2" aria-describedby="score equipe 1" @if($match->points_equipe2 != null) placeholder="{{$match->points_equipe2}}"@else placeholder="--" @endif>
                                            @else
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" @if($match->points_equipe2 != null) placeholder="{{$match->points_equipe2}}"@else placeholder="--" @endif>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="essai-point">
                            <div class="row">
                                <div class="col-4 col-md-12"><span>Resultat</span> __-__</div>
                                <div class="col-4 col-md-12"><span>Essais</span> _</div>
                                <div class="col-4 col-md-12 d-lg-none d-block"><span>Points</span> __</div>
                            </div>
                        </div>
                        @if($match->date_debut_match > date("Y-m-d H:i:s"))
                        <div class="point d-none d-lg-block grey-bg">
                            <p><span class="small-txt">Match pas encore joué</span></p>
                        </div>
                        @else
                        <div class="point d-none d-lg-block">
                            <p><span>__</span><br />POINTS</p>
                        </div>
                        @endif
                        

                    </div>

                    <div class="valid-prono">
                        <div class="row">
                            <div class="col-12 col-md-3 col-md-offset-9 text-right">
                                <button class="cta bg-orange" type="submit">Je valide mon prono ></button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

        @endforeach

    </div>

</div>
@endsection
