<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Resultats extends Controller
{
    //
    public function index()
    {
    	$matchs = DB::table('matchs') ->get();
        //dd($journees);

        return view('resultats',[
            'matchs' => $matchs,
        ]);
        return view('resultats');
    }
}
