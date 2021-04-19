<?php

namespace App\Http\Controllers\Auth;

use App\Events\TouchLastLogin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //qua dentro sta il showLoginform che è  indicato nelle rotte
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    
    // dentro il trait ThrottlesLogins dentro il trait authenticatedUsers ci sono le funzioni maxAttempts e decayMinutes
    // che prendono le medesime proprietà se esistono, altrimenti gli settano i parametri del trait
    public $maxAttempts = 3;
    public $decayMinutes = 60;
    //i tentativi laravel li salva dentro storage>framework>cache>data

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function authenticated(Request $request, $user)
    {
        // if (!$user->email_verified_at){
        //     auth()->logout();
        //     return back()->with( 'warning', 'Devi confermare il tuo indirizzo email prima di poter effetuare il login in Musa Vision');
        // }

        event(new TouchLastLogin($user->id) );

        return redirect()->intended($this->redirectPath());
    }
}
