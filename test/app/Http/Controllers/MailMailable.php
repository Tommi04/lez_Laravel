<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use App\Notifications\TestPreview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailMailable extends Controller
{
    public function index(){
        Mail::to('tommaso.piccio95@gmail.com')
            ->send( new WelcomeMail('Tommaso Piccinini', 'titolo custom', 'contenuto custom'));
    }

    public function preview(){
        $user = User::find(51);
        return (new TestPreview())
            ->toMail($user);
    }
}
