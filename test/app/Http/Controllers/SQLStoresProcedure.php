<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SQLStoresProcedure extends Controller
{
    public function index(){
        
        //come chiamare delle stored procedures
        $users = DB::select(' CALL get_users()'); //tornano array di array
        // $users = User::get(); // tornano oggetti
        dd($users);
        
        $state = 1;
        //chiamare una stor precedure con parametri. ? mentre per più parametri ?,?,?
        $users = DB::select('CALL get_users_by_activation_state(?)', [$state]);
        dd($users);
    }
}
