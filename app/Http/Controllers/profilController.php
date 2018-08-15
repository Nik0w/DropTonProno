<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;

class profilController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

    	$user = DB::table('users')
    				->where('users.id','=',Auth::id())
    				->first();

    	 return view('profil',[
            'user' => $user,
        ]);
    }
}
