<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User' => 'App\Policies\UserPolicy',
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();
        Gate::before(function ($user,$ability) {
            // กำหนดให้ Admin has access to everything.
            if($user->checkRole('SADM')){
                return true;
            }
        });

        Gate::define('SADM', function ($user) {
            return $user->checkRole('SADM');
            //return false;
        });

        Gate::define('MOD', function ($user) {
            return $user->checkRole('MOD');
            //return false;
        });
        Gate::define('EDT', function ($user) {
            return $user->checkRole('EDT');
            //return false;
        });
        Gate::define('VWR', function ($user) {
            return $user->checkRole('VWR');
            //return false;
        });
    }
}
