<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;

class ClassementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $rank_user = 0;
        $points_user = 0;
        $id_user = Auth::id();

        $users = DB::table('users')
                ->leftJoin('points_totaux','points_totaux.id_user','=','users.id')
                ->leftJoin('points as pts_totaux','pts_totaux.id_point','=','points_totaux.id_point')
                ->leftJoin('points_scores','points_scores.id_user','=','users.id')
                ->leftJoin('points as pts_scores','pts_scores.id_point','=','points_scores.id_point')
                ->leftJoin('points_pronos','points_pronos.id_user','=','users.id')
                ->leftJoin('points as pts_pronos','pts_pronos.id_point','=','points_pronos.id_point')
                ->leftJoin('points_mois','points_mois.id_user','=','users.id')
                ->leftJoin('points as pts_mois','pts_mois.id_point','=','points_mois.id_point')
                ->select('id','name','email','password','pts_totaux.nb_points as nb_pts_totaux','pts_scores.nb_points as nb_pts_scores','pts_pronos.nb_points as nb_pts_pronos','pts_mois.nb_points as nb_pts_mois')
                ->orderBy('nb_pts_totaux','DESC')
                ->orderBy('id','ASC')
                ->get();

        $nb_users = $users->count();

        for($i = 0 ; $i < $nb_users ; $i++){
            if($users[$i]->id == $id_user){
                $rank_user = $i + 1;
            }
        }

        $user = DB::table('users')
                ->leftJoin('points_totaux','points_totaux.id_user','=','users.id')
                ->leftJoin('points as pts_totaux','pts_totaux.id_point','=','points_totaux.id_point')
                ->leftJoin('points_scores','points_scores.id_user','=','users.id')
                ->leftJoin('points as pts_scores','pts_scores.id_point','=','points_scores.id_point')
                ->leftJoin('points_pronos','points_pronos.id_user','=','users.id')
                ->leftJoin('points as pts_pronos','pts_pronos.id_point','=','points_pronos.id_point')
                ->leftJoin('points_mois','points_mois.id_user','=','users.id')
                ->leftJoin('points as pts_mois','pts_mois.id_point','=','points_mois.id_point')
                ->leftJoin('images_users','users.id','=','images_users.id_user')
                ->select('name','email','password','pts_totaux.nb_points as nb_pts_totaux','pts_scores.nb_points as nb_pts_scores','pts_pronos.nb_points as nb_pts_pronos','pts_mois.nb_points as nb_pts_mois','images_users.nom_img')
                ->where('id','=',$id_user)
                ->first();

        //dd($users);

        return view('classement',[
            'users' => $users,
            'user' => $user,
            'rank_user' => $rank_user,
            'nb_users' => $nb_users
        ]);
    }
}
