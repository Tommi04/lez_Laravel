<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function profile()
    {
        //ritorna tutto l'utente in questione
        $user = Auth::user();

        //ho solo l'id 
        // $user = Auth::id();

        // dd($user);

        return view('users.profile', compact('user'));
    }

    public function profileUpdate(Request $request){
        $new_name = $request->get('name');

        if ($new_name){
            $user = Auth::user();

            $user->name = $new_name;
            $user->update(['name' => $new_name]);
            // $user->save(); //usare update
            echo 'salvataggio ok';
        }else{
            dd('errore');
            redirect()->back();
        }
    }

    public function deleteProfile(Request $request){
        $user = Auth::user();

        $user->delete();
    }
}
