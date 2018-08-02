<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminJourneeController extends Controller
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

        $journees = DB::table('journees')
                        ->join('championnats', 'journees.id_championnat', '=', 'championnats.id_championnat')
                        ->get();
        $championnats = DB::table('championnats')->get();

        //dd($journees);

        return view('admin.journees',[
            'journees' => $journees,
            'championnats' => $championnats
        ]);
    }

    public function store(Request $request){

        $this->validate($request,[
            'nom_journee' => 'required|max:255',
            'date_debut' => 'required',
            'time_debut' => 'required',
            'date_fin' => 'required',
            'time_fin' => 'required',
            'id_championnat' => 'required'
        ]);

        $nom_journee = $request->input('nom_journee');
        $date_debut = $request->input('date_debut');
        $heure_debut = $request->input('time_debut');
        $date_fin = $request->input('date_fin');
        $heure_fin = $request->input('time_fin');

        $dateTime_debut = $date_debut.' '.$heure_debut.':00';
        $dateTime_fin = $date_fin.' '.$heure_fin.':00';

        $id_championnat = $request->input('id_championnat');

        DB::table('journees')->insert([
            'nom_journee' => $nom_journee,
            'date_debut_journee' => $dateTime_debut,
            'date_fin_journee' => $dateTime_fin,
            'id_championnat' => $id_championnat
        ]);

        return back();
    }

    public function destroy($id){
    	DB::table('journees')->where('id_journee', '=', $id)->delete();
    	return back();
    }

    public function update($id, Request $request){

    	$nom_journee = $request->input('nom_journee');
        $date_debut = $request->input('date_debut');
        $heure_debut = $request->input('time_debut');
        $date_fin = $request->input('date_fin');
        $heure_fin = $request->input('time_fin');

        $dateTime_debut = $date_debut.' '.$heure_debut.':00';
        $dateTime_fin = $date_fin.' '.$heure_fin.':00';

        $id_championnat = $request->input('id_championnat');

    	DB::table('journees')
            ->where('id_journee', $id)
            ->update([
            	'nom_journee' => $nom_journee,
            	'date_debut_journee' => $dateTime_debut,
            	'date_fin_journee' => $dateTime_fin,
                'id_championnat' => $id_championnat
            ]);

        return back();
    }
}
