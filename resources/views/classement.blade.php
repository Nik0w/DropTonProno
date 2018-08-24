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
Des cadeaux seront remis au 1er de chaque mois ainsi qu’aux 3 premiers de la saison régulière.</p>
            </div>

            <div class="col-12 text-center links-classements">
              @if(url()->current() == route('classement'))
                <a class="active select-classement" href="{{url('classement/')}}">Général</a>
                <a class="select-classement" href="{{url('classement/mois')}}">Mois</a>
              @else
                <a class="select-classement" href="{{url('classement/')}}">Général</a>
                <a class="active select-classement" href="{{url('classement/mois')}}">Mois</a>
              @endif
            </div>

            <div class="col-12 col-md-8 offset-md-2 bg-orange classement-user">
              <div class="row">   
                <div class="col-12 col-md-5 text-left">
                  <div class="masque-photo">
                    <img class="img_user" src="{{asset('img/profils/'.$user->nom_img)}}" alt="">
                  </div>
                  <div class="infos_user">
                    <div class="nameUser">
                      {{$user->name}}
                    </div>
                    <div class="rank">
                      <span class="rank-val">{{$rank_user}}</span>
                      <span class="indice">@if($rank_user == 1)er @else ème @endif</span>
                      <span class="slash">/</span>
                      <span class="nb-users">{{$nb_users}}</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-2 offset-md-1 text-center title-scores">
                  <div class="lato">Bons pronos</div>
                  <div class="value-classement">
                    @if($user->nb_pts_pronos != NULL)
                      {{$user->nb_pts_pronos}}
                    @else
                      0
                    @endif
                  </div>
                </div>
                <div class="col-12 col-md-2 text-center title-scores">
                  <div class="lato">Score exacts</div>
                  <div class="value-classement">
                    @if($user->nb_pts_scores != NULL)
                      {{$user->nb_pts_scores}}
                    @else
                      0
                    @endif
                  </div>
                </div>
                <div class="col-12 col-md-2 text-center title-scores">
                  <div class="lato">Points</div>
                  <div class="value-classement">
                    @if($user->nb_pts_totaux != NULL)
                      {{$user->nb_pts_totaux}}
                    @else
                      0
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-8 offset-md-2" style="padding:0;">
              
              <table class="table table-striped bg-white">
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
                    <tr class="top{{$k+(($users->currentPage()-1)*$nb_par_page)+1}}">
                      <th scope="row">{{$k+(($users->currentPage()-1)*$nb_par_page)+1}}</th>
                      <td>{{$u->name}}</td>
                      <td>@if($u->nb_pts_pronos != NULL){{$u->nb_pts_pronos}}@else 0 @endif</td>
                      <td>@if($u->nb_pts_scores!=NULL){{$u->nb_pts_scores}}@else 0 @endif</td>
                      <td>@if($u->nb_pts_totaux!=NULL){{$u->nb_pts_totaux}}@else 0 @endif</td>
                    </tr> 
                  @endforeach
                </tbody>
              </table>
            </div>           

        </div>

        <div class="row paginator">
              <div class="col-12 col-md-8 offset-md-2 text-right">
                {{ $users->links() }}
              </div>
          </div>

    </div>

</div>
@endsection