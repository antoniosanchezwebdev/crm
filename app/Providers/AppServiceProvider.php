<?php

namespace App\Providers;

use App\Models\Alertas;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use Illuminate\Support\Facades\View;

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
        Paginator::useBootstrapFive();
        //
        // $empresa = Settings::whereNull('deleted_at')->first();
        // View::share('empresa', $empresa);
        View::composer('layouts.header', function ($view) {
            if (Auth::check()) { // Asegúrate de que el usuario está autenticado
                // $userId = Auth::id();
                // $userRole = Auth::user()->role;
                // $alertasPendientes = Alertas::where(function ($query) use ($userId, $userRole) {
                //     $query->where('user_id', $userId)
                //           ->orWhereJsonContains('roles', $userRole);
                // })->where('estado_id', 0)->count();
                $alertasPendientes = Alertas::where('estado_id',0)->count();
                $view->with('alertasPendientes', $alertasPendientes);
            }
        });

    }
}
