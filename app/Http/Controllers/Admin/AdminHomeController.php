<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;

class AdminHomeController extends Controller
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
        $nb_users = DB::table('users')->count();
        $nb_pronos = DB::table('pronos')->count();

        return view('admin.home',[
            'nb_users' => $nb_users,
            'nb_pronos' => $nb_pronos
        ]);
    }

}
