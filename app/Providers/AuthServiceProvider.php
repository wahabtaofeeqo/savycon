<?php

namespace SavyCon\Providers;

use Laravel\Passport\Passport;
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
        'SavyCon\Models\UserService' => 'SavyCon\Policies\UserServicePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Gate::define('isAdmin', function($user) {
            return $user->role === 'admin';
        });

        Gate::define('isVendor', function($user) {
            return $user->role === 'vendor';
        });

        Gate::define('isVendorActive', function($user) {
            return $user->active === 1;
        });

        Gate::define('isUser', function($user) {
            return $user->role === 'user';
        });
    }
}
