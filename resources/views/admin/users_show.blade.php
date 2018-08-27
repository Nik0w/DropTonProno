@extends('admin.layouts.admin')

@section('content')

<div class="col-md-12">
    <p>
      <a href="{{url()->previous()}}" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addChampCollapse" aria-expanded="false" aria-controls="addChampCollapse">
        <i class="pe-7s-angle-left"></i>
        Retour
      </a>
    </p>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="header">
            <h4 class="title">Informations du compte</h4>
            <p class="category">Modifier le compte :</p>
            {{$user->name}}
        </div> 
    </div>
</div>

<div class="col-md-6">
    <div class="card">
        <div class="header">
            <h4 class="title">Liste des pronostics</h4>
            <p class="category">Voir / Modifer les pronos</p>
            @foreach($pronos as $prono)
                <div>{{$prono->id_prono}}</div>
            @endforeach
        </div> 
    </div>
</div>

@endsection
