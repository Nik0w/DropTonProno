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
        </div>
      
      <div class="containerProfil">
        <div class="row">
          <div class="col-12 text-center">
            <h1>Mon vestiaire :</h1></div>
        </div>
        <form action="{{url('/vestiaire')}}" method="POST">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2">
              <div class="row">
                
                <div class="col-12 col-sm-5">
                  <div class="masque-photo">
                    <img src="" alt="">
                  </div>
                  <div class="options text-center color-blue">
                    <label for="file" class="label-file">Modifier ma photo</label>
                    <input id="file" class="input-file" type="file">
                  </div>
                  <div class="options text-center color-blue">
                    <a href="{{url('/logout')}}" class="">Se déconnecter</a>
                  </div>
                  <div class="options text-center color-blue"><a href="{{url('')}}" class="">Se désinscrire</a></div>
                </div>

                <div class="col-12 col-sm-7">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <input type="mail" class="form-control" name="mail" value="{{$user->email}}" requiered>
                      </div>
                    </div>
                    <div class="col-12 col-m-7">
                      <div class="form-group">
                        <input type="text" class="form-control" name="name" value="{{$user->name}}" requiered>
                      </div>
                    </div>
                    <div class="col-12 text-right">
                      <button type="submit" class="cta bg-orange">Modifier mes informations</button>
                    </div>
                  </div>                  
                </div>

              </div>
            </div>
            
          </div>
        </form>
      </div>

    </div>

</div>
@endsection