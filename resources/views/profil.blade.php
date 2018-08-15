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
      
      <div class="containerProfil">
        <div class="row">
          <div class="col-12 text-center"><h1>Mon vestiaire :</h1></div>
        </div>
        <form action="" method="POST">
          <div class="row">
            <div class="col-6">
              <h2>Modifier mes informations :</h2>
              <div class="form-group">
                <label for="name">Nom/Pseudo :</label>
                <input type="text" class="form-control" id="name" aria-describedby="emailHelp" value="{{$user->name}}">
              </div>
              <div class="form-group">
                <label for="mail">Adresse mail :</label>
                <input type="text" class="form-control" id="mail" value="{{$user->email}}">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-6">
              <h3>Ma photo de profil :</h3>
            </div>
          </div>
        </form>
      </div>

    </div>

</div>
@endsection