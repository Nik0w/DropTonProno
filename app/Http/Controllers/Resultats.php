<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Resultats extends Controller
{
    //
    public function index()
    {
        $matchs = DB::table('matchs')
                    ->join('journees', 'journees.id_journee', '=', 'matchs.id_journee')
                    ->join('equipes as eq1', 'matchs.id_equipe1', '=', 'eq1.id_equipe')
                    ->join('equipes as eq2', 'matchs.id_equipe2', '=', 'eq2.id_equipe')
                    ->select(['matchs.id_match','matchs.id_equipe1','matchs.id_equipe2','matchs.date_debut_match','matchs.date_fin_match','matchs.id_journee','matchs.score_equipe1','matchs.score_equipe2','eq1.nom_equipe as nom_equipe1','eq1.logo_equipe as logo_equipe1','eq2.nom_equipe as nom_equipe2','eq2.logo_equipe as logo_equipe2','journees.nom_journee'])
                    ->get();
        //dd($matchs);
        return view('resultats',[
            'matchs' => $matchs,
        ]);
        return view('resultats');
    }
}
