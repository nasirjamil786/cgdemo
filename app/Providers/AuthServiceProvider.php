<?php

namespace App\Providers;
use App\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot()
    {
        parent::registerPolicies();


        Gate::before(function ($user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        /*
        foreach($this->getPermissions() as $permission){

            $gate->define($permission->name,function ($user) use ($permission) {

                return $user->hasRole($permission->roles()->get());

            });
        }
        */

    }


    public function getPermissions()
    {
        // return Permission::with('roles')->get();
    }


}
