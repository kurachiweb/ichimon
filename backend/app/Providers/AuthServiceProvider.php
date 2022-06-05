<?php

declare(strict_types=1);

namespace App\Providers;

use App\Guards\AccountAuthZGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        Auth::extend('authz', function ($app) {
            $userProvider = $app->make(AccountProvider::class);
            $request = $app->make('request');
            return new AccountAuthZGuard('authz', $userProvider, $request);
        });
    }
}
