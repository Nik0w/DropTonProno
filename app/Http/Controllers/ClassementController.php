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
        $points_user = 0;
        $users = DB::table('users')->get();
        $user = DB::table('users')
                ->where('users.id','=',Auth::id())
                ->first();

        $points_global_req = DB::table('points')
                            ->join('pronos','pronos.id_point','=','points.id_point')
                            ->where('pronos.id_user','=',Auth::id())
                            ->select('nb_points')
                            ->get();

        foreach($points_global_req as $point){
            $points_user += $point->nb_points;
        }

        return view('classement',[
            'users' => $users,
            'user' => $user,
            'points_user' => $points_user
        ]);
    }
}
