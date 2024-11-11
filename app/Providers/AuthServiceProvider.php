<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Implicitly grant "Super-Admin" role all permission checks using can()
        $superAdminEmail = Config('constants.SUPER_ADMIN_EMAIL');

        // allows super admin everywhere in the app
        Gate::before(function (User $user) use ($superAdminEmail) {
            return $user->email === $superAdminEmail ? true : null;
        });
    }
}
