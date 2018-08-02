<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminEquipesController extends Controller
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
    public function index(){

        $equipes = DB::table('equipes')->get();

        return view('admin.equipes',[
            'equipes' => $equipes
        ]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'nom_equipe' => 'required|max:255',
            'logo_equipe' => 'required|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ]);

        $nom_equipe = $request->input('nom_equipe');

        if ($request->hasFile('logo_equipe')) {
            $image = $request->file('logo_equipe');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/img/equipes');
            $image->move($destinationPath, $name);

            DB::table('equipes')->insert([
                'nom_equipe' => $nom_equipe,
                'logo_equipe' => $name
            ]);

            return back()->with('success','Image Upload successfully');
        }else{

            return back();
        }

    }

    public function destroy($id){
    	DB::table('championnats')->where('id_championnat', '=', $id)->delete();
    	return back();
    }

    public function update($id, Request $request){

    	$nom_championnat = $request->input('nom_championnat');
        $date_debut = $request->input('date_debut');
        $heure_debut = $request->input('time_debut');
        $date_fin = $request->input('date_fin');
        $heure_fin = $request->input('time_fin');

        $dateTime_debut = $date_debut.' '.$heure_debut.':00';
        $dateTime_fin = $date_fin.' '.$heure_fin.':00';

    	DB::table('championnats')
            ->where('id_championnat', $id)
            ->update([
            	'nom_championnat' => $nom_championnat,
            	'date_debut_championnat' => $dateTime_debut,
            	'date_fin_championnat' => $dateTime_fin
            ]);

        return back();
    }
}
