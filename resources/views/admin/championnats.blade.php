@extends('admin.layouts.admin')

@section('content')

<div class="col-md-12">
    <p>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addChampCollapse" aria-expanded="false" aria-controls="addChampCollapse">
        <i class="pe-7s-plus"></i>
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
                {{ csrf_field() }}
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
            <p class="category">Les championnats regroupent les journées</p>
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
                            <form class="inline-block" action="{{url()->current().'/'.$championnat->id}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn" type="submit"><i class="pe-7s-close"></i>Supprimer</button>
                            </form>

                            <button class="btn" type="button" data-toggle="collapse" data-target="#{{'editChampCollapse'.$championnat->id}}" aria-expanded="false" aria-controls="{{'editChampCollapse'.$championnat->id}}">
                            <i class="pe-7s-edit"></i>
                            Modifier
                          </button>
                        </td>

                        <div class="collapse" id="{{'editChampCollapse'.$championnat->id}}">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Modifier le championnat</h4>
                                </div>
                                <div class="content">
                                    <form action="{{url()->current().'/'.$championnat->id}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nom du championnat :</label>
                                                    <input type="text" class="form-control" placeholder="nom :" name="nom_championnat" value="{{$championnat->nom}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date de début :</label>
                                                    <input type="date" name="date_debut" class="form-control" value="{{date_format(new DateTime($championnat->date_debut), 'Y-m-d')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Heure de début :</label>
                                                    <input type="time" name="time_debut" class="form-control" value="{{date_format(new DateTime($championnat->date_debut), 'H:i')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date de fin :</label>
                                                    <input type="date" name="date_fin" class="form-control" value="{{date_format(new DateTime($championnat->date_fin), 'Y-m-d')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Heure de fin :</label>
                                                    <input type="time" name="time_fin" class="form-control" value="{{date_format(new DateTime($championnat->date_fin), 'H:i')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-fill pull-right">Modifier</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </tr>
                    

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
