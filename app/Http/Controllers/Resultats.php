<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Response;

class Resultats extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index($id)
    {

    	$this->checkPoints();

        $matchs = DB::table('matchs')
                    ->join('journees', 'journees.id_journee', '=', 'matchs.id_journee')
                    ->join('equipes as eq1', 'matchs.id_equipe1', '=', 'eq1.id_equipe')
                    ->join('equipes as eq2', 'matchs.id_equipe2', '=', 'eq2.id_equipe')
                    ->leftJoin('pronos', function($join){
					        $join->on('pronos.id_match', '=', 'matchs.id_match')
					        ->where('pronos.id_user', '=', Auth::id());
					})
                    ->leftJoin('points', 'points.id_point', '=', 'pronos.id_point')
                    ->where('matchs.id_journee','=',$id)
                    ->select(['matchs.id_match','matchs.id_equipe1','matchs.id_equipe2','matchs.date_debut_match','matchs.date_fin_match','matchs.id_journee','matchs.score_equipe1','matchs.score_equipe2','matchs.nb_essai_match','eq1.nom_equipe as nom_equipe1','eq1.logo_equipe as logo_equipe1','eq2.nom_equipe as nom_equipe2','eq2.logo_equipe as logo_equipe2','journees.nom_journee','pronos.points_equipe1','pronos.points_equipe2','pronos.nb_essai_prono','points.nb_points'])
                    ->orderBy('matchs.date_debut_match', 'asc')
                    ->get();
        //dd($matchs);
        $journees = DB::table('journees')
                    ->get();
        
        //dd($matchs);
        return view('resultats',[
            'matchs' => $matchs,
            'journees' => $journees
        ]);
    }

    // CREATION OU MISE A JOUR DU SCORE GENERAL

    public function UpdateScoreGeneral($score){

        //check si l user a deja un score total
        $score_general = DB::table('points_totaux')
                            ->where('points_totaux.id_user','=',Auth::id())
                            ->first();

        // IL Y A DEJA UN SCORE TOTAL
        if($score_general != NULL){

            DB::table('points')
                ->where('points.id_point','=',$score_general->id_point)
                ->increment('nb_points', $score);

        }else{

            $pointsInsertID = DB::table('points')->insertGetId([
                'nb_points' => $score,
            ]);

            DB::table('points_totaux')->insert([
                'id_user' => Auth::id(),
                'id_point' => $pointsInsertID,
            ]);
        }
    }

    // CREATION OU MISE A JOUR DU SCORE DU NOMBRE DE SCORE EXACTS PRONOSTICES

    public function UpdateScoresExacts($score_pts_exacts){

        //check si l user a deja un score total
        $score_exacts = DB::table('points_scores')
                            ->where('points_scores.id_user','=',Auth::id())
                            ->first();

        // IL Y A DEJA UN SCORE Exact
        if($score_exacts != NULL){

            DB::table('points')
                ->where('points.id_point','=',$score_exacts->id_point)
                ->increment('nb_points', $score_pts_exacts);

        }else{

            $pointsInsertID = DB::table('points')->insertGetId([
                'nb_points' => $score_pts_exacts,
            ]);

            DB::table('points_scores')->insert([
                'id_user' => Auth::id(),
                'id_point' => $pointsInsertID,
            ]);
        }
    }

    // CREATION OU MISE A JOUR DU SCORE DU NOMBRE DE BON PRONO REALISE

    public function UpdateScoresPronos($score_nb_pronos){

        //check si l user a deja un score total
        $score_pronos = DB::table('points_pronos')
                            ->where('points_pronos.id_user','=',Auth::id())
                            ->first();

        // IL Y A DEJA UN SCORE Exact
        if($score_pronos != NULL){

            DB::table('points')
                ->where('points.id_point','=',$score_pronos->id_point)
                ->increment('nb_points', $score_nb_pronos);

        }else{

            $pointsInsertID = DB::table('points')->insertGetId([
                'nb_points' => $score_nb_pronos,
            ]);

            DB::table('points_pronos')->insert([
                'id_user' => Auth::id(),
                'id_point' => $pointsInsertID,
            ]);
        }
    }

    // CREATION OU MISE A JOUR DU SCORE DU MOIS EN COURS

    public function UpdateScoresMois($score){

        $mois_en_cours = date('m');

        //check si l user a deja un score mois
        $score_mois = DB::table('points_mois')
                        ->where('points_mois.id_user','=',Auth::id())
                        ->where('points_mois.num_mois','=',$mois_en_cours)
                        ->first();

        // IL Y A DEJA UN SCORE Exact
        if($score_mois != NULL){

            DB::table('points')
                ->where('points.id_point','=',$score_mois->id_point)
                ->increment('nb_points', $score);

        }else{

            $pointsInsertID = DB::table('points')->insertGetId([
                'nb_points' => $score
            ]);

            DB::table('points_mois')->insert([
                'id_user' => Auth::id(),
                'num_mois' => $mois_en_cours,
                'id_point' => $pointsInsertID
            ]);
        }
    }


    public function checkPoints(){
    	$score = 0;
    	$score_pts_exacts = 0;
    	$score_bon_prono = 0;

    	$pronosTermines = DB::table('pronos')
                    ->join('matchs', 'matchs.id_match', '=', 'pronos.id_match')
                    ->where('pronos.id_user','=',Auth::id())
                    ->where('pronos.is_active','=','1')
                    ->where('pronos.id_point','=',NULL)
                    ->where('matchs.date_fin_match','<',date("Y-m-d H:i:s"))
                    ->get();
        // PRONOS PASSES ET ACTIFS
        foreach ($pronosTermines as $prono) {
        	//si equipe 1 gagne et prono equipe 1 gagnante
        	if($prono->score_equipe1 != NULL && $prono->score_equipe2 != NULL){

	        	if($prono->points_equipe1 > $prono->points_equipe2 
	        		&& $prono->score_equipe1 > $prono->score_equipe2){
	    			$score+=5;
	        	}
	        	//si equipe 2 gagne et prono equipe 2 gagnante
	        	if($prono->points_equipe2 > $prono->points_equipe1 
	        		&& $prono->score_equipe2 > $prono->score_equipe1){
	    			$score+=5;
	        	}
	        	//ecart de 3 score equipe 1
	        	if($prono->points_equipe1 >= $prono->score_equipe1 - 3
	        		&& $prono->points_equipe1 <= $prono->score_equipe1 + 3
	        		&& $prono->points_equipe1 != $prono->score_equipe1){
	        		$score += 3;
	        	}
	        	// ecart de 3 score equipe 2
	        	if($prono->points_equipe2 >= $prono->score_equipe2 - 3
	        		&& $prono->points_equipe2 <= $prono->score_equipe2 + 3
	        		&& $prono->points_equipe2 != $prono->score_equipe2){
	        		$score += 3;
	        	}
	        	//si score nombre d essai est bon
	        	if($prono->nb_essai_prono == $prono->nb_essai_match){
	        		$score += 10;
	        	}
	        	//si score exact equipe 1 ou equipe 2
	        	if($prono->points_equipe1 == $prono->score_equipe1 xor $prono->points_equipe2 == $prono->score_equipe2){
	        		$score+=20;
	        		$score_pts_exacts ++;
	        	}
	        	//si score exact equipe 1 et equipe 2 mais pas match nul
	        	else if($prono->points_equipe1 == $prono->score_equipe1 && $prono->points_equipe2 == $prono->score_equipe2 && $prono->points_equipe1 != $prono->points_equipe2){
	        		$score+=40;
	        		$score_pts_exacts += 2;
	        	}
	        	//si nul prono et nul match
	        	else if($prono->points_equipe1 == $prono->points_equipe2 && $prono->score_equipe1 == $prono->score_equipe2 && $prono->points_equipe1 != $prono->score_equipe1){
	        		$score+=30;
	        	}
	        	else if($prono->points_equipe1 == $prono->points_equipe2 && $prono->score_equipe1 == $prono->score_equipe2 && $prono->points_equipe1 == $prono->score_equipe1){
	        		$score+=70;
	        		$score_pts_exacts += 2;
	        	}

                if($score > 0){
                    $score_bon_prono ++;
                }

                $this->UpdateScoreGeneral($score);
                $this->UpdateScoresExacts($score_pts_exacts);
                $this->UpdateScoresPronos($score_bon_prono);
                $this->UpdateScoresMois($score);

                $pointsInsertID = DB::table('points')->insertGetId([
                    'nb_points' => $score,
                ]);

		        DB::table('pronos')
		            ->where('id_prono','=', $prono->id_prono)
		            ->update([
		            	'id_point' => $pointsInsertID,
			            'is_active' => '0'
		            ]);

		        $score = 0;
    			$score_pts_exacts = 0;
    			$score_bon_prono = 0;
	    	}
        }

    }

    public function createProno(Request $request, $id){

    	$this->validate($request,[
            'score_equipe1' => 'required',
            'score_equipe2' => 'required',
            'match' => 'required',
        ]);

    	// SI PAS DIE PRONO SUR LE NOMBRE D ESSAI : ENREGISTRE 0 EN VALEUR PAR DEFAUT
        $score_essais = 0;

        $id_equipe1 = $request->input('id_equipe1');
        $id_equipe2 = $request->input('id_equipe2');
        $id_match = $request->input('match');
        $score_equipe1 = $request->input('score_equipe1');
        $score_equipe2 = $request->input('score_equipe2');
		$score_essais = $request->input('score_essais');
		$id_user = Auth::id();

        $match = DB::table('matchs')
                    ->where('matchs.id_match','=',$id_match)
                    ->first();

        if(date("Y-m-d H:i:s") >= $match->date_debut_match){
        	return Response::json(array('success'=>false,'message'=>'Ce match est déjà commencé'));
            //return redirect()->back()->with('error','Ce match est déjà commencé !');
        }else{

            $prono = DB::table('pronos')
                        ->join('users', 'pronos.id_user', '=', 'users.id')
                        ->where('pronos.id_match','=',$request->input('match'))
                        ->where('pronos.id_user','=',$id_user)
                        ->first();

            //dd($prono);
            if($prono != NULL){
            	// UN PRONO A DEJA ETAIT FAIT
            	DB::table('pronos')
                ->where('id_prono','=', $prono->id_prono)
                ->update([
                	'points_equipe1' => $score_equipe1,
    	            'points_equipe2' => $score_equipe2,
    	            'nb_essai_prono' => $score_essais
                ]);
            }else{
            	// PAS DE PRONO SUR CE MATCH
    	    	DB::table('pronos')->insert([
    	    		'id_match' => $id_match,
    	            'points_equipe1' => $score_equipe1,
    	            'points_equipe2' => $score_equipe2,
    	            'id_user' => $id_user,
    	            'nb_essai_prono' => $score_essais,
    	            'is_active' => 1
    	        ]);
            }
            return Response::json(array('success'=>true,'message'=>'Pronostic à jour !'));
            //return redirect()->back()->with('success','Le pronostic a bien était crée/édité');

        }
    }
}
