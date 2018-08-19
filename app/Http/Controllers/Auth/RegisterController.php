<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/resultats/1';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user_id = $user->id;
        $score = 10;

        $pre_inscris = DB::table('pre_inscription')
                        ->where('pre_inscription.email_user','=',$user->email)
                        ->first();
        if($pre_inscris != null){
             //check si l user a deja un score total
            $score_general = DB::table('points_totaux')
                                ->where('points_totaux.id_user','=',$user_id)
                                ->first();

            // IL Y A DEJA UN SCORE TOTAL
            if($score_general != NULL){

                DB::table('points')
                    ->where('points.id_point','=',$score_general->id_point)
                    ->increment('nb_points', $score);

            }else{

                $pointsInsertID = DB::table('points')->insertGetId([
                    'nb_points' => $score,
                ]);

                DB::table('points_totaux')->insert([
                    'id_user' => $user_id,
                    'id_point' => $pointsInsertID,
                ]);
            }
        }

        return $user;


    }
}
