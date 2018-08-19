<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminMatchsController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){

        $matchs = DB::table('matchs')
                    ->join('journees', 'journees.id_journee', '=', 'matchs.id_journee')
                    ->join('equipes as eq1', 'matchs.id_equipe1', '=', 'eq1.id_equipe')
                    ->join('equipes as eq2', 'matchs.id_equipe2', '=', 'eq2.id_equipe')
                    ->select(['matchs.id_match','matchs.id_equipe1','matchs.id_equipe2','matchs.date_debut_match','matchs.date_fin_match','matchs.id_journee','matchs.score_equipe1','matchs.score_equipe2','matchs.nb_essai_match','eq1.nom_equipe as nom_equipe1','eq2.nom_equipe as nom_equipe2','journees.nom_journee'])
                    ->get();

        $equipes = DB::table('equipes')->get();
        $journees = DB::table('journees')->get();

        //dd($journees);

        return view('admin.matchs',[
            'matchs' => $matchs,
            'journees' => $journees,
            'equipes' => $equipes
        ]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'id_equipe1' => 'required',
            'id_equipe2' => 'required',
            'date_debut' => 'required',
            'time_debut' => 'required',
            'date_fin' => 'required',
            'time_fin' => 'required',
            'id_journee' => 'required'
        ]);

        $id_equipe1 = $request->input('id_equipe1');
        $id_equipe2 = $request->input('id_equipe2');
        $score_equipe1 = $request->input('score_equipe1');
        $score_equipe2 = $request->input('score_equipe2');
        $nb_essai_match = $request->input('nb_essai');
        $date_debut = $request->input('date_debut');
        $heure_debut = $request->input('time_debut');
        $date_fin = $request->input('date_fin');
        $heure_fin = $request->input('time_fin');

        $dateTime_debut = $date_debut.' '.$heure_debut.':00';
        $dateTime_fin = $date_fin.' '.$heure_fin.':00';

        $id_journee = $request->input('id_journee');

        DB::table('matchs')->insert([
            'id_equipe1' => $id_equipe1,
            'id_equipe2' => $id_equipe2,
            'id_journee' => $id_journee,
            'score_equipe1' => $score_equipe1,
            'score_equipe2' => $score_equipe2,
            'nb_essai_match' => $nb_essai_match,
            'date_debut_match' => $dateTime_debut,
            'date_fin_match' => $dateTime_fin
        ]);

        return back();
    }

    public function destroy($id){
    	DB::table('matchs')->where('id_match', '=', $id)->delete();
    	return back();
    }

    public function update($id, Request $request){

        //dd($request->input());

    	$id_equipe1 = $request->input('id_equipe1');
        $id_equipe2 = $request->input('id_equipe2');
        $score_equipe1 = $request->input('score_equipe1');
        $score_equipe2 = $request->input('score_equipe2');
        $nb_essai_match = $request->input('nb_essai');
        $date_debut = $request->input('date_debut');
        $heure_debut = $request->input('time_debut');
        $date_fin = $request->input('date_fin');
        $heure_fin = $request->input('time_fin');

        $dateTime_debut = $date_debut.' '.$heure_debut.':00';
        $dateTime_fin = $date_fin.' '.$heure_fin.':00';

        $id_journee = $request->input('id_journee');

    	DB::table('matchs')
            ->where('id_match', $id)
            ->update([
            	'id_equipe1' => $id_equipe1,
                'id_equipe2' => $id_equipe2,
                'id_journee' => $id_journee,
                'score_equipe1' => $score_equipe1,
                'score_equipe2' => $score_equipe2,
                'nb_essai_match' => $nb_essai_match,
                'date_debut_match' => $dateTime_debut,
                'date_fin_match' => $dateTime_fin
            ]);

        return back();
    }
}
