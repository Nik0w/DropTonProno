<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

    // CREATION OU MISE A JOUR DU SCORE GENERAL

    public function UpdateScoreGeneral($score){

        //check si l user a deja un score total
        $score_general = DB::table('points_totaux')
                            ->where('points_totaux.id_user','=',$id_user)
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
                'id_user' => $id_user,
                'id_point' => $pointsInsertID,
            ]);
        }
    }

    // CREATION OU MISE A JOUR DU SCORE DU NOMBRE DE SCORE EXACTS PRONOSTICES

    public function UpdateScoresExacts($score_pts_exacts){

        //check si l user a deja un score total
        $score_exacts = DB::table('points_scores')
                            ->where('points_scores.id_user','=',$id_user)
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
                'id_user' => $id_user,
                'id_point' => $pointsInsertID,
            ]);
        }
    }

    // CREATION OU MISE A JOUR DU SCORE DU NOMBRE DE BON PRONO REALISE

    public function UpdateScoresPronos($score_nb_pronos){

        //check si l user a deja un score total
        $score_pronos = DB::table('points_pronos')
                            ->where('points_pronos.id_user','=',$id_user)
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
                'id_user' => $id_user,
                'id_point' => $pointsInsertID,
            ]);
        }
    }

    // CREATION OU MISE A JOUR DU SCORE DU MOIS EN COURS

    public function UpdateScoresMois($score){

        $mois_en_cours = date('m');

        //check si l user a deja un score total
        $score_mois = DB::table('points_mois')
                        ->where('points_mois.id_user','=',$id_user)
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
                'id_user' => $id_user,
                'num_mois' => $mois_en_cours,
                'id_point' => $pointsInsertID
            ]);
        }
    }


    public function checkPoints($id_user){
    	$score = 0;
    	$score_pts_exacts = 0;
    	$score_bon_prono = 0;

    	$pronosTermines = DB::table('pronos')
                    ->join('matchs', 'matchs.id_match', '=', 'pronos.id_match')
                    ->where('pronos.id_user','=',$id_user)
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
	        	//si score exact equipe 1 ou equipe 2
	        	if($prono->points_equipe1 == $prono->score_equipe1 xor $prono->points_equipe2 == $prono->score_equipe2){
	        		$score+=20;
	        		$score_pts_exacts ++;
	        	}
	        	//si match nul et prono match nul
	        	else if($prono->points_equipe1 == $prono->score_equipe1 && $prono->points_equipe2 == $prono->score_equipe2 && $prono->points_equipe1 == $prono->score_equipe1){
	        		$score+=30;
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
	    	}
        }

}
