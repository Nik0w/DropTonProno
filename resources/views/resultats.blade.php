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
        <div class="row debug">
            <div class="col-12">DEBUG :<hr></div>
            <div class="col-12">POST : 
                {{var_dump($_POST)}}
                <hr></div>
            <div class="col-12">GET :
                {{var_dump($_GET)}}</div>
        </div>
        <div class="row resultats">
            <div class=".d-none .d-sm-block col-md-8 encartPub"></div>

            <div class="col-12">
                <p>Bienvenue à toi l'ami</p>
                <p>Viens faire tes pronos ! Victoire de l'UBB ? Défaite de Clermont ?</p>
                <p>Monte au classement pour gagner des >cadeaux</p>
            </div>

        </div>

        <div class="tableau-res">
            <form action="" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="match" value="1">
                <div class="bg-white padding-top">
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 col-md-10">
                                    <div class="row">
                                        <div class="col-6 logo-equipe padding-left">
                                            <img src="{{ asset('img/logo-ubb.png') }}">
                                        </div>
                                        <div class="col-6 nom-equipe"><div><h2>Union Bordeaux Begles</h2></div></div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-2 score-equipe-1">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="score_equipe1" name="score_equipe1" aria-describedby="score equipe 1" placeholder="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12 col-sm-10 col-sm-push-2">
                                    <div class="row">
                                        <div class="col-6 nom-equipe"><div><h2>Stade Toulousain</h2></div></div>
                                        <div class="col-6 logo-equipe text-right padding-right">
                                            <img src="{{ asset('img/logo-toulouse.png') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-2 col-sm-pull-10">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="score_equipe2" name="score_equipe2" aria-describedby="score equipe 2" placeholder="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="essai-point">
                        <div class="row">
                            <div class="col-4 col-md-12"><span>Resultat</span> 25-12</div>
                            <div class="col-4 col-md-12"><span>Essais</span> 4</div>
                            <div class="col-4 col-md-12 d-lg-none d-block"><span>Points</span> 17</div>
                        </div>
                    </div>

                    <div class="point d-none d-lg-block">
                        <p>
                            <span>17</span>
                            <br />POINTS
                        </p>
                    </div>

                </div>

                <div class="valid-prono">
                    <div class="row">
                        <div class="col-12 col-md-3 col-md-offset-9 text-right">
                            <button class="cta bg-orange" type="submit">Je valide mon prono !</button>
                        </div>
                    </div>
                </div>

            </form>

        </div>

    </div>

</div>
@endsection
