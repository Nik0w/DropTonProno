@extends('admin.layouts.admin')

@section('content')

<div class="col-md-12">
    <p>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addChampCollapse" aria-expanded="false" aria-controls="addChampCollapse">
        <i class="pe-7s-plus"></i>
        Créer une journée
      </button>
    </p>
    <div class="collapse" id="addChampCollapse">
      <div class="card">
        <div class="header">
            <h4 class="title">Créer une journée</h4>
        </div>
        <div class="content">
            <form action="" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nom de la journée :</label>
                            <input type="text" class="form-control" placeholder="nom :" name="nom_journee" value="">
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
                            <label>Séléctionner le championnat :</label>
                            <select class="form-control" name="id_championnat">
                                <option selected>Choose...</option>
                                @foreach($championnats as $championnat)
                                    <option value="{{$championnat->id_championnat}}">{{$championnat->nom_championnat}}</option>
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
            <h4 class="title">Liste des Journées</h4>
            <p class="category">Les journées regroupent les matchs</p>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Championnat</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($journees as $journee)

                    <tr>
                        <td>{{$journee->id_journee}}</td>
                        <td>{{$journee->nom_journee}}</td>
                        <td>{{$journee->date_debut_journee}}</td>
                        <td>{{$journee->date_fin_journee}}</td>
                        <td>
                            {{$journee->nom_championnat}}
                        </td>
                        <td>
                            <form class="inline-block" action="{{url()->current().'/'.$journee->id_journee}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn" type="submit"><i class="pe-7s-close"></i>Supprimer</button>
                            </form>

                            <button class="btn" type="button" data-toggle="collapse" data-target="#{{'editChampCollapse'.$journee->id_journee}}" aria-expanded="false" aria-controls="{{'editChampCollapse'.$journee->id_journee}}">
                            <i class="pe-7s-edit"></i>
                            Modifier
                          </button>
                        </td>
                        
                        <div class="collapse" id="{{'editChampCollapse'.$journee->id_journee}}">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Modifier la journee</h4>
                                </div>
                                <div class="content">
                                    <form action="{{url()->current().'/'.$journee->id_journee}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nom du journee :</label>
                                                    <input type="text" class="form-control" placeholder="nom :" name="nom_championnat" value="{{$journee->nom_journee}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date de début :</label>
                                                    <input type="date" name="date_debut" class="form-control" value="{{date_format(new DateTime($journee->date_debut_journee), 'Y-m-d')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Heure de début :</label>
                                                    <input type="time" name="time_debut" class="form-control" value="{{date_format(new DateTime($journee->date_debut_journee), 'H:i')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Date de fin :</label>
                                                    <input type="date" name="date_fin" class="form-control" value="{{date_format(new DateTime($journee->date_fin_journee), 'Y-m-d')}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Heure de fin :</label>
                                                    <input type="time" name="time_fin" class="form-control" value="{{date_format(new DateTime($journee->date_fin_journee), 'H:i')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Championnat :</label>
                                                   <select class="form-control" name="id_championnat">
                                                    <option selected>Choose...</option>
                                                    @foreach($championnats as $championnat)
                                                        <option value="{{$championnat->id_championnat}}">{{$championnat->nom_championnat}}</option>
                                                    @endforeach
                                                </select>
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
