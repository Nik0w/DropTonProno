<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;

class ClassementMoisController extends Controller
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
        $nb_par_page = 30;

        $users = DB::table('users')
                ->leftJoin('points_totaux','points_totaux.id_user','=','users.id')
                ->leftJoin('points as pts_totaux','pts_totaux.id_point','=','points_totaux.id_point')
                ->leftJoin('points_scores','points_scores.id_user','=','users.id')
                ->leftJoin('points as pts_scores','pts_scores.id_point','=','points_scores.id_point')
                ->leftJoin('points_pronos','points_pronos.id_user','=','users.id')
                ->leftJoin('points as pts_pronos','pts_pronos.id_point','=','points_pronos.id_point')
                ->leftJoin('points_mois', function($join){
                    $join->on('points_mois.id_user','=','users.id')
                    ->where('num_mois', '=', date('m'));
                })
                ->leftJoin('points as pts_mois','pts_mois.id_point','=','points_mois.id_point')
                ->select('id','name','email','password','pts_totaux.nb_points as nb_pts_totaux','pts_scores.nb_points as nb_pts_scores','pts_pronos.nb_points as nb_pts_pronos','pts_mois.nb_points as nb_pts_mois')
                ->orderBy('nb_pts_mois','DESC')
                ->orderBy('id','ASC')
                ->groupBy('email')
                ->distinct()
                ->get();

        $nb_users = $users->count();

        for($i = 0 ; $i < $nb_users ; $i++){
            if($users[$i]->id == $id_user){
                $rank_user = $i + 1;
            }
        }

        $users = DB::table('users')
                ->leftJoin('points_totaux','points_totaux.id_user','=','users.id')
                ->leftJoin('points as pts_totaux','pts_totaux.id_point','=','points_totaux.id_point')
                ->leftJoin('points_scores','points_scores.id_user','=','users.id')
                ->leftJoin('points as pts_scores','pts_scores.id_point','=','points_scores.id_point')
                ->leftJoin('points_pronos','points_pronos.id_user','=','users.id')
                ->leftJoin('points as pts_pronos','pts_pronos.id_point','=','points_pronos.id_point')
                ->leftJoin('points_mois', function($join){
                    $join->on('points_mois.id_user','=','users.id')
                    ->where('num_mois', '=', date('m'));
                })
                ->leftJoin('points as pts_mois','pts_mois.id_point','=','points_mois.id_point')
                ->select('id','name','email','password','pts_totaux.nb_points as nb_pts_totaux','pts_scores.nb_points as nb_pts_scores','pts_pronos.nb_points as nb_pts_pronos','pts_mois.nb_points as nb_pts_mois')
                ->orderBy('nb_pts_mois','DESC')
                ->orderBy('id','ASC')
                ->groupBy('email')
                ->distinct()
                ->paginate($nb_par_page);

        $user = DB::table('users')
                ->leftJoin('points_totaux','points_totaux.id_user','=','users.id')
                ->leftJoin('points as pts_totaux','pts_totaux.id_point','=','points_totaux.id_point')
                ->leftJoin('points_scores','points_scores.id_user','=','users.id')
                ->leftJoin('points as pts_scores','pts_scores.id_point','=','points_scores.id_point')
                ->leftJoin('points_pronos','points_pronos.id_user','=','users.id')
                ->leftJoin('points as pts_pronos','pts_pronos.id_point','=','points_pronos.id_point')
                ->leftJoin('points_mois', function($join){
                    $join->on('points_mois.id_user','=','users.id')
                    ->where('num_mois', '=', date('m'));
                })
                ->leftJoin('points as pts_mois','pts_mois.id_point','=','points_mois.id_point')
                ->leftJoin('images_users','users.id','=','images_users.id_user')
                ->select('name','email','password','pts_totaux.nb_points as nb_pts_totaux','pts_scores.nb_points as nb_pts_scores','pts_pronos.nb_points as nb_pts_pronos','pts_mois.nb_points as nb_pts_mois','images_users.nom_img')
                ->where('id','=',$id_user)
                ->first();

        //dd($users);

         $favoris = DB::table('favoris')
                    ->where('id_user','=',$id_user)
                    ->select('favoris_ids')
                    ->first();

        if($favoris != NULL){

            $favoris = $favoris->favoris_ids;

            $favoris_array = explode(',',$favoris);

        }else{
            $favoris_array = [];
        }

        return view('classement',[
            'users' => $users,
            'user' => $user,
            'rank_user' => $rank_user,
            'nb_users' => $nb_users,
            'nb_par_page' => $nb_par_page,
            'favoris' => $favoris_array
        ]);
    }

    public function search(Request $request){
        $name_user = $request->input('user_name');

        $favoris = DB::table('favoris')
                    ->where('id_user','=', Auth::id())
                    ->select('favoris_ids')
                    ->first();

        $users = DB::table('users')
                    ->where('users.name','like','%'.$name_user.'%')
                    ->select('users.id','users.name')
                    ->get();

        //dd($results);

        return array($users,$favoris);
    }

    public function updateFavoris(Request $request){

        $id_user = Auth::id();
        $id_favoris = $request->id_user;

        //check si l user a deja unu table favoris
        $favoris_table = DB::table('favoris')
                        ->where('id_user','=',$id_user)
                        ->first();

        if($favoris_table != NULL){

            $favoris = $favoris_table->favoris_ids;
            $favoris_array = explode(',',$favoris);

            if(in_array(strval($id_favoris),$favoris_array)){

                $favoris_array = array_merge(array_diff($favoris_array, array($id_favoris)));
                $ids = implode(',',$favoris_array);

            }else{

                $ids = $favoris_table->favoris_ids.','.$id_favoris;
            }

            DB::table('favoris')
                ->where('id_user','=',$id_user)
                ->update(['favoris_ids'=> $ids]);
        }else{

            DB::table('favoris')->insert([
                'id_user' => $id_user,
                'favoris_ids' => $id_favoris
            ]);

        }

    }
}
