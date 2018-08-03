@extends('layouts.app')

@section('content')

@include('includes.menu')
<div class="bg-img">

    <div class="nuages">
            <img class="nuage" src="img/nuages1.png" alt="">
            <img class="nuage" src="img/nuages2.png" alt="">
            <img class="nuage" src="img/nuages3.png" alt="">
    </div>


    <div class="container">

        <div class="row resultats">
            <div class=".d-none .d-sm-block col-md-8 encartPub"></div>

            <div class="col-12 text-center">
                <h1>Classement des joueurs</h1>
                <p>Bienvenue à toi l'ami</p>
                <p>Viens faire tes pronos ! Victoire de l'UBB ? Défaite de Clermont ?</p>
                <p>Monte au classement pour gagner des >cadeaux</p>
            </div>

        </div>

        <div class="row classement">
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
                <tr class="top1">
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>32</td>
                  <td>32</td>
                  <td>32</td>
                </tr>
                <tr class="top2">
                  <th scope="row">2</th>
                  <td>Mark</td>
                  <td>32</td>
                  <td>32</td>
                  <td>32</td>
                </tr>
                <tr class="top3">
                  <th scope="row">3</th>
                  <td>Mark</td>
                  <td>32</td>
                  <td>32</td>
                  <td>32</td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>Mark</td>
                  <td>32</td>
                  <td>32</td>
                  <td>32</td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>Mark</td>
                  <td>32</td>
                  <td>32</td>
                  <td>32</td>
                </tr>
              </tbody>
            </table>
        </div>

        
    </div>
    
</div>
@endsection
