<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

use App\Models\User;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //se non sono loggato non raggiungo la funzione verify
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    
    //facendo così, cioè copiando qua il metodo del trait VerifiesEmails, questo qua sotto ha il sopravvento
    //sul metodo del trait e posso modificarlo visto che sta qua e non in vendor
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request){

        $user = User::find($request->id());

        // if ($request->user()->hasVerifiedEmail()) {
        if ($user->hasVerifiedEmail()) { //hasVerifiedEmail() metodo dell'interfaccia authenticable che torna true o false se l'utente è già registrato o meno
            return redirect($this->redirectPath());
        }

        // if ($request->user()->markEmailAsVerified()) {
        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }
}