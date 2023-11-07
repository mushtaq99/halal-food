<?php

namespace App\Providers;

use App\Models\country;
use App\Models\Permission;
use App\Models\User;
use App\Policies\CountryPolicy;
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
        country::class => CountryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(static function (User $user) {
            if($user->hasRole('super-admin')) {
                return true;
            }

            return null;
        });


        $permissions = Permission::get();
        foreach ($permissions as $permission) {
            Gate::define($permission->slug, function (User $user) use ($permission) {
               // dd($permission->roles->toArray());
                /* now we will check here if the authentic user role and permission role are same
                it mean allow that user*/
               return  $user->hasRole($permission->roles);


            });
        }
    }
}
