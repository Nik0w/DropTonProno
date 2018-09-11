@extends('admin.layouts.admin')

@section('content')

 <div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Gestion des scores</h4>
            </p>
            <br>
        </div>
        
    </div>
</div>

<div class="col-md-12">

    <form class="inline-block" action="{{url()->current()}}" method="POST">
        {{ csrf_field() }}
        <button class="btn btn-primary" type="submit" name="calcul" value="1">Calculer tous les scores</button>
    </form> 
</div>

<div class="col-md-12">
    <br><hr><br>
    <div class="card">
        <div class="header">
            <h4 class="title">HARD RESET</h4>
            <p class="category">Attention à ce que vous faites ici...
            <br>
        </div>
        
    </div>
</div>

<div class="col-md-12">      

        <form class="inline-block" action="{{url()->current()}}" method="POST">
            {{ csrf_field() }}
            <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit" name="reset" value="1">RESET SCORE ET RECALCUL</button>
        </form> 
</div>

@endsection
