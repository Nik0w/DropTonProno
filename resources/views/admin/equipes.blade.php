@extends('admin.layouts.admin')

@section('content')

<div class="col-md-12">
    <p>
      <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addChampCollapse" aria-expanded="false" aria-controls="addChampCollapse">
        <i class="pe-7s-plus"></i>
        Créer une équipe
      </button>
    </p>
    <div class="collapse" id="addChampCollapse">
      <div class="card">
        <div class="header">
            <h4 class="title">Créer une équipe</h4>
        </div>
        <div class="content">
            <form action="" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nom de l'équipe :</label>
                            <input type="text" class="form-control" placeholder="nom :" name="nom_equipe" value="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="fileInput">Example file input</label>
                        <input type="file" name="logo_equipe" class="form-control-file" id="fileInput">
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
            <h4 class="title">Liste des Equipes</h4>
            <p class="category">Retrouvez ici toutes les équipes créees</p>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Logo</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($equipes as $equipe)

                    <tr>
                        <td>{{$equipe->id_equipe}}</td>
                        <td>{{$equipe->nom_equipe}}</td>
                        <td><img style="max-width: 80px;" src="{{asset('img/equipes/'.$equipe->logo_equipe)}}" alt=""></td>
                        <td>
                            <form class="inline-block" action="{{url()->current().'/'.$equipe->id_equipe}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn" type="submit"><i class="pe-7s-close"></i>Supprimer</button>
                            </form>

                            <button class="btn" type="button" data-toggle="collapse" data-target="#{{'editChampCollapse'.$equipe->id_equipe}}" aria-expanded="false" aria-controls="{{'editChampCollapse'.$equipe->id_equipe}}">
                            <i class="pe-7s-edit"></i>
                            Modifier
                          </button>
                        </td>

                        <div class="collapse" id="{{'editChampCollapse'.$equipe->id_equipe}}">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Modifier l'équipe</h4>
                                </div>
                                <div class="content">
                                    <form action="{{url()->current().'/'.$equipe->id_equipe}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Nom du equipe :</label>
                                                    <input type="text" class="form-control" placeholder="nom :" name="nom_championnat" value="">
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
