<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use DateTime;

class AdminResetScoresController extends Controller
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
    public function index()
    {
        return view('admin.scores');
    }

    public function post(Request $request){

        //dd($request);
        if($request->calcul){
            $this->calculPoints();
        }
        elseif($request->reset){
            $this->hardReset();
        }
        
        return back();
        
    }

    public function calculPoints(){

        $users = DB::table('users')->get();

        foreach ($users as $user) {

            $this->checkPoints($user->id);
        }

    }

    public function hardReset()
    {

        $users = DB::table('users')->get();

        // On vide toutes les tables en relation avec les scores
        DB::table('points')->truncate();
        DB::table('points_mois')->truncate();
        DB::table('points_pronos')->truncate();
        DB::table('points_scores')->truncate();
        DB::table('points_totaux')->truncate();

        DB::table('pronos')
        ->update([
            'is_active' => 1,
            'id_point' => NULL
        ]);

        foreach ($users as $user) {

            $this->checkPoints($user->id);
        }

    }

       // CREATION OU MISE A JOUR DU SCORE GENERAL

    public function UpdateScoreGeneral($score,$id){

        //check si l user a deja un score total
        $score_general = DB::table('points_totaux')
                            ->where('points_totaux.id_user','=',$id)
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
                'id_user' => $id,
                'id_point' => $pointsInsertID,
            ]);
        }
    }

    // CREATION OU MISE A JOUR DU SCORE DU NOMBRE DE SCORE EXACTS PRONOSTICES

    public function UpdateScoresExacts($score_pts_exacts,$id){

        //check si l user a deja un score total
        $score_exacts = DB::table('points_scores')
                            ->where('points_scores.id_user','=',$id)
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
                'id_user' => $id,
                'id_point' => $pointsInsertID,
            ]);
        }
    }

    // CREATION OU MISE A JOUR DU SCORE DU NOMBRE DE BON PRONO REALISE

    public function UpdateScoresPronos($score_nb_pronos,$id){

        //check si l user a deja un score total
        $score_pronos = DB::table('points_pronos')
                            ->where('points_pronos.id_user','=',$id)
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
                'id_user' => $id,
                'id_point' => $pointsInsertID,
            ]);
        }
    }

    // CREATION OU MISE A JOUR DU SCORE DU MOIS EN COURS

    public function UpdateScoresMois($mois,$score,$id){

        //check si l user a deja un score mois
        $score_mois = DB::table('points_mois')
                        ->where('points_mois.id_user','=',$id)
                        ->where('points_mois.num_mois','=',$mois)
                        ->first();

        // IL Y A DEJA UN SCORE mois
        if($score_mois != NULL){

            DB::table('points')
                ->where('points.id_point','=',$score_mois->id_point)
                ->increment('nb_points', $score);

        }else{

            $pointsInsertID = DB::table('points')->insertGetId([
                'nb_points' => $score
            ]);

            DB::table('points_mois')->insert([
                'id_user' => $id,
                'num_mois' => $mois,
                'id_point' => $pointsInsertID
            ]);
        }
    }


    public function checkPoints($id){
        $score = 0;
        $score_pts_exacts = 0;
        $score_bon_prono = 0;

        $pronosTermines = DB::table('pronos')
                    ->join('matchs', 'matchs.id_match', '=', 'pronos.id_match')
                    ->where('pronos.id_user','=',$id)
                    ->where('pronos.is_active','=','1')
                    ->where('pronos.id_point','=',NULL)
                    ->where('matchs.date_fin_match','<',date("Y-m-d H:i:s"))
                    ->get();
        //dd($pronosTermines);
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

                $mois = date_format(new DateTime($prono->date_fin_match), 'm');

                $this->UpdateScoreGeneral($score,$id);
                $this->UpdateScoresExacts($score_pts_exacts,$id);
                $this->UpdateScoresPronos($score_bon_prono,$id);
                $this->UpdateScoresMois($mois,$score,$id);

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

        $score_mois = [];

    }


}
