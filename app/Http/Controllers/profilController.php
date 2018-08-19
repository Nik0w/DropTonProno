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

    public function updateInfos(Request $request){
    	$this->validate($request,[
            'mail' => 'required|max:255',
            'name' => 'required'
        ]);
    	$user_id = Auth::id();
        $name = $request->input('name');
        $mail = $request->input('mail');
    	
    	DB::table('users')
            ->where('id', $user_id)
            ->update([
            	'name' => $name,
            	'email' => $mail
            ]);
        return redirect()->back()->with('success','Voter profil a bien était modifié');
    }
}
