<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use File;

use Auth;

class profilController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

    	$user = DB::table('users')
    				->leftJoin('images_users','users.id','=','images_users.id_user')
    				->where('users.id','=',Auth::id())
    				->first();

    	 return view('profil',[
            'user' => $user,
        ]);
    }

    public function updateInfos(Request $request){

    	$user_id = Auth::id();

    	if($request->file('img_user') == null){

	    	$this->validate($request,[
	            'mail' => 'required|max:255',
	            'name' => 'required'
	        ]);
	        $name = $request->input('name');
	        $mail = $request->input('mail');
	    	
	    	DB::table('users')
	            ->where('id', $user_id)
	            ->update([
	            	'name' => $name,
	            	'email' => $mail
	            ]);
	        return redirect()->back()->with('success','Votre profil a bien était modifié');
    	}else{

    		$this->validate($request,[
	            'img_user' => 'required|image|max:1200'
	        ]);

	        $img_user = DB::table('images_users')
        					->where('images_users.id_user','=',$user_id)
        					->first();

			if($img_user == null){

	    		$image = $request->file('img_user');
	            $name = time().'.'.$image->getClientOriginalExtension();
	            $destinationPath = public_path('/img/profils');
	            $image->move($destinationPath, $name);

	            DB::table('images_users')->insert([
	                'id_user' => $user_id,
	                'nom_img' => $name
	            ]);

			}else{

				$file = public_path('img/profils/').$img_user->nom_img;
				File::delete($file);

				$image = $request->file('img_user');
	            $name = time().'.'.$image->getClientOriginalExtension();
	            $destinationPath = public_path('/img/profils');
	            $image->move($destinationPath, $name);

	            DB::table('images_users')
		            ->where('images_users.id_user', $user_id)
		            ->update(['nom_img' => $name]);
						
			}


            return redirect()->back()->with('success','Votre image de profil a été modifiée');
    	}
    }
}
