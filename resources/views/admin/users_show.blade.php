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

<div class="col-md-4">
	<div class="card">
			<div class="header">
					<h4 class="title">Informations du compte</h4>
					<p class="category">Modifier le compte :</p>
					{{$user->name}}
			</div> 
	</div>
</div>

<div class="col-md-8">
		<div class="card">
				<div class="header">
						<h4 class="title">Liste des pronostics</h4>
						<p class="category">Voir / Modifer les pronos</p>
						<div class="content table-responsive table-full-width">
								<table class="table table-hover table-striped">
										<thead>
												<th>ID</th>
												<th>Equipe1</th>
												<th>Equipe2</th>
												<th>Points</th>
												<th>Actions</th>
										</thead>
										<tbody>
												@foreach($pronos as $prono)

												<tr>
														<td>{{$prono->id_prono}}</td>
														<td>{{$prono->nom_equipe1}}</td>
														<td>{{$prono->nom_equipe2}}</td>
														<td>{{$prono->nb_points}}</td>
														<td>
																<form class="inline-block" action="{{url()->current().'/'.$prono->id_prono}}" method="POST">
																		{{ csrf_field() }}
																		<button class="btn" type="submit"><i class="pe-7s-close"></i>Supprimer</button>
																</form>

																<form class="inline-block" action="{{url()->current().'/'.$prono->id_prono}}" method="POST">
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
</div>

@endsection
