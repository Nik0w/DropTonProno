<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;

class Resultats extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $matchs = DB::table('matchs')
                    ->join('journees', 'journees.id_journee', '=', 'matchs.id_journee')
                    ->join('equipes as eq1', 'matchs.id_equipe1', '=', 'eq1.id_equipe')
                    ->join('equipes as eq2', 'matchs.id_equipe2', '=', 'eq2.id_equipe')
                    ->leftJoin('pronos', 'matchs.id_match', '=', 'pronos.id_match')
                    ->select(['matchs.id_match','matchs.id_equipe1','matchs.id_equipe2','matchs.date_debut_match','matchs.date_fin_match','matchs.id_journee','matchs.score_equipe1','matchs.score_equipe2','eq1.nom_equipe as nom_equipe1','eq1.logo_equipe as logo_equipe1','eq2.nom_equipe as nom_equipe2','eq2.logo_equipe as logo_equipe2','journees.nom_journee','pronos.points_equipe1','pronos.points_equipe2','pronos.nb_essai_prono'])
                    ->orderBy('matchs.date_debut_match', 'asc')
                    ->get();
        
        //dd($matchs);
        $this->checkPoints();
        return view('resultats',[
            'matchs' => $matchs,
        ]);
        return view('resultats');
    }

    public function checkPoints(){
    	 $pronosTermines = DB::table('pronos')
                    ->join('matchs', 'matchs.id_match', '=', 'pronos.id_match')
                    ->where('pronos.id_user','=',Auth::id())
                    ->where('pronos.is_active','=','1')
                    ->where('pronos.id_point','=',NULL)
                    ->where('matchs.date_fin_match','<',date("Y-m-d H:i:s"))
                    ->get();
    	dd($pronosTermines);
    }

    public function createProno(Request $request){

    	$this->validate($request,[
            'score_equipe1' => 'required',
            'score_equipe2' => 'required',
            'match' => 'required',
        ]);

        $id_equipe1 = $request->input('id_equipe1');
        $id_equipe2 = $request->input('id_equipe2');
        $id_match = $request->input('match');
        $score_equipe1 = $request->input('score_equipe1');
        $score_equipe2 = $request->input('score_equipe2');
		$id_user = Auth::id();

        $prono = DB::table('pronos')
                    ->join('users', 'pronos.id_user', '=', 'users.id')
                    ->where('pronos.id_match','=',$request->input('match'))
                    ->first();

        //dd($prono);
        if(count($prono) > 0){
        	// UN PRONO A DEJA ETAIT FAIT
        	DB::table('pronos')
            ->where('id_prono','=', $prono->id_prono)
            ->update([
            	'points_equipe1' => $score_equipe1,
	            'points_equipe2' => $score_equipe2,
	            'nb_essai_prono' => 0
            ]);
        }else{
        	// PAS DE PRONO SUR CE MATCH
	    	DB::table('pronos')->insert([
	    		'id_match' => $id_match,
	            'points_equipe1' => $score_equipe1,
	            'points_equipe2' => $score_equipe2,
	            'id_user' => $id_user,
	            'nb_essai_prono' => 0,
	            'is_active' => 1
	        ]);
        }
        return back();
    }
}
