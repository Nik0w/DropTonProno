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

        
        <div class="row classement">
            <div class=".d-none .d-sm-block col-md-8 encartPub"></div>

            <div class="col-12 text-resultats color-blue text-center">
              <h1>Classement des joueurs</h1>
              <p>Bienvenue à toi l'ami<br />
              Viens faire tes pronos ! Victoire de l'UBB ? Défaite de Clermont ?<br />
              Monte au classement pour <button class="small-cta bg-orange">gagner des cadeaux</button></p>
            </div>

            <div class="col-12 col-md-8 offset-md-2 bg-orange classement-user">
              <div class="row">              
                <div class="col-5">
                  <div class="nameUser">{{$user->name}}</div>
                </div>
                <div class="offset-1"></div>
                <div class="col-2 text-center">
                  <div class="lato">Bons pronos</div>
                  <div class="value-classement">32</div>
                </div>
                <div class="col-2 text-center">
                  <div class="lato">Score exacts</div>
                  <div class="value-classement">15</div>
                </div>
                <div class="col-2 text-center">
                  <div class="lato">Points</div>
                  <div class="value-classement">{{$points_user}}</div>
                </div>
              </div>
            </div>

            <table class="table table-striped bg-white col-md-8 offset-md-2">
              <thead class="bg-bleu lato">
                <tr>
                  <th scope="col">Rang</th>
                  <th scope="col">Prénom</th>
                  <th scope="col">Bons pronos</th>
                  <th scope="col">Scores exacts</th>
                  <th scope="col">Points</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $k=>$u)
                  <tr class="top1">
                    <th scope="row">{{$k+1}}</th>
                    <td>{{$u->name}}</td>
                    <td>{{$u->nb_pts_pronos}}</td>
                    <td>{{$u->nb_pts_scores}}</td>
                    <td>{{$u->nb_pts_totaux}}</td>
                  </tr> 
                @endforeach
              </tbody>
            </table>

        </div>

    </div>

</div>
@endsection