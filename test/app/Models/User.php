<?php

namespace App\Models;

use App\Events\UserDeleted;
use App\Events\UserUpdated;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /*
      trait per far funzionare il modello in soft deleting.
      però a questo punto bisogna aggiungere la colonna "deleted_at" alla table users
      migration Alter_User_Table_Add_Deleted_At_Column
      chi avrà la colonna deleted_at no a null sarà estromesso da qualsiasi query
      a meno di non usare la funzione User::withTrashed()->get() per eseguire la query
      per prendere solo i cancellati invece ::onlyTrashed()
    */
    use SoftDeletes;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //campi che possiamo compilare in mass assignement. Quali campi spossiamo assegnare in massa
    //in questo caso siccome è escluso l'id non possiamo creare utenti in massa
    protected $fillable = [
        'name', 'email', 'password', 'role', 'last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //auto with. JOIN automatiche. con nome della relazione nell'array
    //potro usare User::get() e non più User::with('details')->get();
    protected $with = [
        'details',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    //ci consente di farci tornare dei dati in maniera diversa rispetto a cosa sono
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function details(){
        //relazione per user_details, un user più user_details
        return $this->hasOne('App\Models\UserDetails');
    }

    public function tickets(){
        //relazione per user_details, un user più user_details
        return $this->hasMany('App\Models\Ticket');
    }

    public function userRole(){
        return $this->belongsTo('App\Models\Role', 'role', 'id' );
    }

    public function scopeActive($query){
        return $query->where('email_verified_at', '<>', null);
    }

    public function scopeNotActive($query){
        return $query->where('email_verified_at', null);
    }

    public function scopeStatus($query, $status){
        if ($status === true){
            return $query->where('email_verified_at', '<>', null);
            //uguale
            // return $query->whereNotNull('email_verified_at');
        }else{
            return $query->where('email_verified_at', null);
            //uguale
            // return $query->whereNull('email_verified_at');
        }
    }

    public function hasRole($role){
        return $this->userRole->code === $role;
    }
    
    protected $dispatchesEvents = [
        'updated' => UserUpdated::class,
        'deleted' => UserDeleted::class
    ];

}
