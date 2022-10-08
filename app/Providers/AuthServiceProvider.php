<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
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
    public function boot()
    {
        $this->registerPolicies();
        // 管理者のみ許可
        Gate::define('admin-role', function ($user) {
            return ($user->role == 2);
        });
        // 一般ユーザ以上（つまり全権限）に許可
        Gate::define('user-role', function ($user) {
            return ($user->role > 0);
        });
        //
    }
}
