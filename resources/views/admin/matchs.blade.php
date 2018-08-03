@extends('admin.layouts.admin')

@section('content')

<div class="col-md-12">
    <p>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addChampCollapse" aria-expanded="false" aria-controls="addChampCollapse">
        <i class="pe-7s-plus"></i>
        Créer un match
      </button>
    </p>
    <div class="collapse" id="addChampCollapse">
      <div class="card">
        <div class="header">
            <h4 class="title">Créer un match</h4>
        </div>
        <div class="content">
            <form action="" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Equipe 1 :</label>
                            <select class="form-control" name="id_equipe1">
                                <option selected>Choose...</option>
                                @foreach($equipes as $equipe)
                                    <option value="{{$equipe->id_equipe}}">{{$equipe->nom_equipe}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Equipe 2 :</label>
                            <select class="form-control" name="id_equipe2">
                                <option selected>Choose...</option>
                                @foreach($equipes as $equipe)
                                    <option value="{{$equipe->id_equipe}}">{{$equipe->nom_equipe}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Score équipe 1 :</label>
                            <input type="text" class="form-control" placeholder="score :" name="score_equipe1" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Score équipe 2 :</label>
                            <input type="text" class="form-control" placeholder="score :" name="score_equipe2" value="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nombre d'essais :</label>
                            <input type="text" class="form-control" placeholder="nombre d'essai :" name="nb_essai" value="">
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Séléctionner la journée :</label>
                            <select class="form-control" name="id_journee">
                                <option selected>Choose...</option>
                                @foreach($journees as $journee)
                                    <option value="{{$journee->id_journee}}">{{$journee->nom_journee}}</option>
                                @endforeach
                            </select>
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
            <h4 class="title">Liste des Matchs</h4>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Equipe 1</th>
                    <th>Equipe 2</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Journée</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($matchs as $match)

                    <tr>
                        <td>{{$match->id_match}}</td>
                        <td>{{$match->nom_equipe1}}</td>
                        <td>{{$match->nom_equipe2}}</td>
                        <td>{{$match->date_debut_match}}</td>
                        <td>{{$match->date_fin_match}}</td>
                        <td>{{$match->nom_journee}}</td>
                        <td>
                            <form class="inline-block" action="{{url()->current().'/'.$match->id_match}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn" type="submit"><i class="pe-7s-close"></i>Supprimer</button>
                            </form>

                            <button class="btn" type="button" data-toggle="collapse" data-target="#{{'editChampCollapse'.$match->id_match}}" aria-expanded="false" aria-controls="{{'editChampCollapse'.$match->id_match}}">
                            <i class="pe-7s-edit"></i>
                            Modifier
                          </button>
                        </td>
                        
                        <div class="collapse" id="{{'editChampCollapse'.$match->id_match}}">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Modifier le match</h4>
                                </div>
                                <div class="content">
                                    <form action="{{url()->current().'/'.$match->id_match}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        

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
