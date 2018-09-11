@extends('layouts.app')

@section('content')

<div class="container-fluid header-welcome">
    <div class="col-12 text-center">
        <a href="{{url('/')}}"><img class="img-fluid" src="{{asset('img/logo.png')}}" alt=""></a>
    </div>
</div>

<div class="container-fuid">
    
    <div class="bg-img">

        <div class="container container-home color-blue">
            <div class="row">

                <div class="col-12 col-md-8 offset-md-2 text-center">
                    <h1 class="title-welcome">Site en maintenance...</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2 text-center">
                    <h2 class="text-center">Mais revenez très vite pour ne râter aucun pronos !</h2>
                </div>
            </div>
        </div>
        

    </div>

</div>

    
</div>
@endsection