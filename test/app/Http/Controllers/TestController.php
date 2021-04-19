<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;

//creiamo un controller per vedere i dati della console al volo
class TestController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //come chiamare lo scope, nomescope() prima lettera minuscola poi dalle parole dopo la prima lettera maiuscola
        $users = User::active()->get();
        // $users = User::notActive()->get();

        //qua sotto chiamo lo scope status con un parametro
        // $users = User::status(true)->get();

        //altro modo per chiamarlo dentro una funzione
        // $user_details = UserDetails::with(['user' => function($q){
        //     return $q->active();
        // }])->get();

        foreach ($users as $u => $user) {
            echo $user->name . '<br>';
        }
        // foreach ($user_details as $u => $user_detail) {
        //     echo $user_detail->user->name . '<br>';
        // }
    }
}
