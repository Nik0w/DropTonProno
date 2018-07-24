@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row resultats">
        <div class=".d-none .d-sm-block col-md-8 encartPub"></div>

        <div class="col-12">
            <p>Bienvenue à toi l'ami</p>
            <p>Viens faire tes pronos ! Victoire de l'UBB ? Défaite de Clermont ?</p>
            <p>Monte au classement pour gagner des >cadeaux</p>
        </div>

    </div>

    <div class="tableau-res">

        <div class="row">

            <div class="col-6 equipe-left border-right">

                <div class="row">

                    <div class="col-6 logo-equipe">
                        <img src="{{ asset('img/logo-ubb.png') }}">
                    </div>
                    <div class="col-6 nom-equipe"><h2>Union Bordeaux Begles</h2></div>

                </div>

            </div>

            <div class="col-6 equipe-right">

                <div class="row text-right">

                    <div class="col-6 nom-equipe"><h2>Stade Toulousain</h2></div>
                    <div class="col-6 logo-equipe">
                        <img src="{{ asset('img/logo-toulouse.png') }}">

                    </div>

                </div>

            </div>

        </div>

            <div class="score">
                <div class="row">
                    <div class="col-6">20</div>
                    <div class="col-6">13</div>
                </div>
            </div>

            <div class="essai-point">
                <div class="row">
                    <div class="col-4 border-right">Resultat : 25-12</div>
                    <div class="col-4 border-right">Essais : 4</div>
                    <div class="col-4">Points : 17</div>
                </div>
            </div>



    </div>

    <div class="tableau-res">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="col-12 col-md-10">
                        <div class="row">
                            <div class="col-6 logo-equipe">
                                <img src="{{ asset('img/logo-ubb.png') }}">
                            </div>
                            <div class="col-6 nom-equipe"><h2>Union Bordeaux Begles</h2></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Score">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12 col-sm-10 col-sm-push-2">
                        <div class="row">
                            <div class="col-6 nom-equipe"><h2>Stade Toulousain</h2></div>
                            <div class="col-6 logo-equipe text-right">
                                <img src="{{ asset('img/logo-toulouse.png') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-2 col-sm-pull-10">
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Score">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="essai-point">
            <div class="row">
                <div class="col-4 col-md-12">Resultat : 25-12</div>
                <div class="col-4 col-md-12">Essais : 4</div>
                <div class="col-4">Points : 17</div>
            </div>
        </div>

    </div>

</div>
@endsection
