<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use DateTime;

class AdminUsersController extends Controller
{

		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
				$users = DB::table('users')
										->paginate(50);

				//dd($journees);

				return view('admin.users',[
						'users' => $users
				]);
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
				//
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
				//
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */

		public function show($id)
		{
				$user = DB::table('users')
										->where('users.id','=',$id)
										->first();
				
				$pronos = DB::table('matchs')
										->join('journees', 'journees.id_journee', '=', 'matchs.id_journee')
										->join('equipes as eq1', 'matchs.id_equipe1', '=', 'eq1.id_equipe')
										->join('equipes as eq2', 'matchs.id_equipe2', '=', 'eq2.id_equipe')
										->leftJoin('pronos', 'pronos.id_match', '=', 'matchs.id_match')
										->where('pronos.id_user', '=', $id)
										->leftJoin('points', 'points.id_point', '=', 'pronos.id_point')
										->select(['matchs.id_match','matchs.id_equipe1','matchs.id_equipe2','matchs.date_debut_match','matchs.date_fin_match','matchs.id_journee','matchs.score_equipe1','matchs.score_equipe2','matchs.nb_essai_match','eq1.nom_equipe as nom_equipe1','eq1.logo_equipe as logo_equipe1','eq2.nom_equipe as nom_equipe2','eq2.logo_equipe as logo_equipe2','journees.nom_journee','pronos.points_equipe1','pronos.points_equipe2','pronos.nb_essai_prono','points.nb_points','pronos.id_prono'])
										->orderBy('matchs.date_debut_match', 'asc')
										->orderBy('matchs.id_match', 'asc')
										->get();

				return view('admin.users_show',[
						'user' => $user,
						'pronos' => $pronos
				]);
		}

		public function search(Request $request){
				$name_user = $request->input('user_name');

				$users = DB::table('users')
								->where('users.name','like','%'.$name_user.'%')
								->get();

				 return $users;
		}

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function edit($id)
		{
				//
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request  $request
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, $id)
		{
				//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{

		}

		public function deleteProno($id_user, $id_prono){

			$prono = DB::table('pronos')
										->where('pronos.id_prono','=',$id_prono)
										->leftjoin('points','points.id_point','=','pronos.id_point')
										->leftjoin('matchs','matchs.id_match','=','pronos.id_match')
										->first();
			//dd($prono);
			if( ($prono->is_active == 1 && $prono->id_point == 0) || $prono->nb_points == 0 ){

				DB::table('pronos')
						->where('prono.id_prono','=',$id_prono)
						->delete();

			}else{
				
				$points = $prono->nb_points;
				$nb_score = $points < 40 ? 1 : 2;
				$mois_prono = date_format(new DateTime($prono->date_fin_match), 'm');
				
				DB::table('points_totaux')
						->where('id_user','=',$id_user)
						->leftjoin('points','points.id_point','=','points_totaux.id_point')
						->decrement('nb_points', $points);

				DB::table('points_scores')
						->where('id_user','=',$id_user)
						->leftjoin('points','points.id_point','=','points_scores.id_point')
						->decrement('nb_points', $nb_score);

				DB::table('points_pronos')
						->where('id_user','=',$id_user)
						->leftjoin('points','points.id_point','=','points_pronos.id_point')
						->decrement('nb_points', 1);

				DB::table('points_mois')
						->where('id_user','=',$id_user)
						->where('num_mois','=',$mois_prono)
						->leftjoin('points','points.id_point','=','points_mois.id_point')
						->decrement('nb_points', $points);

				DB::table('pronos')
						->where('pronos.id_prono','=',$id_prono)
						->delete();
					
			}

			return back();

		}
}
