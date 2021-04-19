<?php

namespace App\Providers;

use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        //'App\Models\User' => 'App\policies\UserPolicy
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        //impostiamo i gates
        //$user glielo inietta da solo con l'utente che in quel momento è in sessione
        Gate::define('can-admin', function($user){
            //il return deve essere un true o un false
            return $user->hasRole('admin');
        });
    }
}
