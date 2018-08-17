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

            <div class="col-12 col-md-8 offset-md-2 text-classement color-blue text-center">
              <h1>Le Classement</h1>
              <p>Découvrez votre position après chaque journée de Top 14 avec un classement mensuel et général. <br />
Des cadeaux seront remis au 1er de chaque mois ainsi qu’aux 3er de la saison régulière.</p>
            </div>

            <div class="col-12 col-md-8 offset-md-2 bg-orange classement-user">
              <div class="row">              
                <div class="col-5">
                  <div class="nameUser">{{$user->name}}</div>
                </div>
                <div class="offset-1"></div>
                <div class="col-2 text-center">
                  <div class="lato">Bons pronos</div>
                  <div class="value-classement">{{$user->nb_pts_pronos}}</div>
                </div>
                <div class="col-2 text-center">
                  <div class="lato">Score exacts</div>
                  <div class="value-classement">{{$user->nb_pts_scores}}</div>
                </div>
                <div class="col-2 text-center">
                  <div class="lato">Points</div>
                  <div class="value-classement">{{$user->nb_pts_totaux}}</div>
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