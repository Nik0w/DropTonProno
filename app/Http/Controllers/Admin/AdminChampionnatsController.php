<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminChampionnatsController extends Controller
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

        $championnats = DB::table('championnats')->get();

        return view('admin.championnats',[
            'championnats' => $championnats
        ]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'nom_championnat' => 'required|max:255',
            'date_debut' => 'required',
            'time_debut' => 'required',
            'date_fin' => 'required',
            'time_fin' => 'required'
        ]);

        $nom_championnat = $request->input('nom_championnat');
        $date_debut = $request->input('date_debut');
        $heure_debut = $request->input('time_debut');
        $date_fin = $request->input('date_fin');
        $heure_fin = $request->input('time_fin');

        $dateTime_debut = $date_debut.' '.$heure_debut.':00';
        $dateTime_fin = $date_fin.' '.$heure_fin.':00';

        DB::table('championnats')->insert([
            'nom' => $nom_championnat,
            'date_debut' => $dateTime_debut,
            'date_fin' => $dateTime_fin
        ]);

        return back();
    }

    public function destroy($id){
    	DB::table('championnats')->where('id', '=', $id)->delete();
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
            ->where('id', $id)
            ->update([
            	'nom' => $nom_championnat,
            	'date_debut' => $dateTime_debut,
            	'date_fin' => $dateTime_fin
            ]);

        return back();
    }
}
