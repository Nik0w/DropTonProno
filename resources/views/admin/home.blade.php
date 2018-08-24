@extends('admin.layouts.admin')

@section('content')

<div class="row">

	<div class="col-md-4">
	    <div class="card">

	        <div class="header">
	            <h4 class="title">Utilisateurs</h4>
	            <p class="category">Nombre d'utilisateurs</p>
	        </div>
	        <div class="content">
	            <div class="val">{{$nb_users}}</div>
	        </div>
	    </div>
	</div>

	<div class="col-md-4">
	    <div class="card">

	        <div class="header">
	            <h4 class="title">Pronostics</h4>
	            <p class="category">Nombre de pronos</p>
	        </div>
	        <div class="content">
	            <div class="val">{{$nb_pronos}}</div>
	        </div>
	    </div>
	</div>

	<div class="col-md-4">
	    <div class="card">

	        <div class="header">
	            <h4 class="title">Pronostics</h4>
	            <p class="category">Nombre de pronos</p>
	        </div>
	        <div class="content">
	            <div class="val">{{$nb_pronos}}</div>
	        </div>
	    </div>
	</div>

</div>

@endsection
