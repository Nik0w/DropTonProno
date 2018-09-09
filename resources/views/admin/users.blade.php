@extends('admin.layouts.admin')

@section('content')

<div class="col-md-12">
    <p>
        <form action="{{url()->current()}}/search">
           <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><i class="pe-7s-search"></i></span>
              <input id="searchUsers" type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" name="user_name">
            </div>
        </form>
    </p>
</div>

 <div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title">Liste des Utilisateurs</h4>
            <p class="category">Retrouvez ici tous les joueurs</p>
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($users as $user)

                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        <td>
                            <form class="inline-block" action="{{url()->current().'/'.$user->id}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn" type="submit"><i class="pe-7s-close"></i>Supprimer</button>
                            </form>

                            <form class="inline-block" action="{{url()->current().'/'.$user->id}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}
                                <button class="btn" type="submit"><i class="pe-7s-edit"></i>Modifier</button>
                            </form>
                        </td>
                    </tr>
                    

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
