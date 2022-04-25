<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

use Livewire\Livewire;
use App\Domains\Auth\Users\UsersTable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        //$this->registerPolicies();

 
        Gate::define('isAdmin', function($user) {
            $user_role = DB::table('user_roles')->where('user_email', $user->email)->first();
            return $user_role->role == 'admin';
         });

         
         Gate::define('isEditor', function($user) {
            $user_role = DB::table('user_roles')->where('user_email', $user->email)->first();
            return $user_role->role == 'editor';
         });


         Gate::define('isViewer', function($user) {
            $user_role = DB::table('user_roles')->where('user_email', $user->email)->first();
            return $user_role->role == 'viewer';
         });

         view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);
        });


    }
}
