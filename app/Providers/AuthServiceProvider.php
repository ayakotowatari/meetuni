<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Only institution admin can access.
        Gate::define('institution', function($user){
            return $user -> user_type_id == 1 || 2;
        });

        Gate::define('superAdmin', function($user){
            return $user -> user_type_id == 1;
        });

        Gate::define('student', function($user){
            return $user -> user_type_id == 6;
        });

        // Gate :: define ( 'inst-admin' , function ( $user ){
        //     return $user -> user_type_id == 2;
        // });
    }
}
