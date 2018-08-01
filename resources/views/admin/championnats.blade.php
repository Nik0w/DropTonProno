@extends('admin.layouts.admin')

@section('content')

<div class="col-md-12">
    <p>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addChampCollapse" aria-expanded="false" aria-controls="addChampCollapse">
        Créer un championnat
      </button>
    </p>
    <div class="collapse" id="addChampCollapse">
      <div class="card">
        <div class="header">
            <h4 class="title">Créer un championnat</h4>
        </div>
        <div class="content">
            <form action="" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nom du championnat :</label>
                            <input type="text" class="form-control" placeholder="nom :" name="nom_championnat" value="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date de début :</label>
                            <input type="date" name="date_debut" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Heure de début :</label>
                            <input type="time" name="time_debut" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date de fin :</label>
                            <input type="date" name="date_fin" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Heure de fin :</label>
                            <input type="time" name="time_fin" class="form-control">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info btn-fill pull-right">Créer</button>
                <div class="clearfix"></div>
            </form>
        </div>
    </div>
</div>
</div>

 <div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Liste des Championnats</h4>
            <p class="category">Here is a subtitle for this table</p>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($championnats as $championnat)

                    <tr>
                        <td>{{$championnat->id}}</td>
                        <td>{{$championnat->nom}}</td>
                        <td>{{$championnat->date_debut}}</td>
                        <td>{{$championnat->date_fin}}</td>
                        <td>
                            <a href="#">Delete</a>
                            <a href="#">Modify</a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
