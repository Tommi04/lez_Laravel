<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterUser extends Model
{
    protected $table = 'newsletter_users';

    public function srcUser(){
        //la prima dopo la path alla classe è la chiave esterna qui, la seconda è la cella di là
        return $this->belongsTo('App\Models\User', 'base_user_id', 'id');
    }

    public function srcUserDetails(){
        return $this->belongsTo('App\Models\UserDetails', 'base_user_id', 'user_id');
    }
}
