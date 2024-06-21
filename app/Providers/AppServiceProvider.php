<?php

namespace App\Providers;

use App\Models\solicitud;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Gate::before(fn(User $user) => $user->perfil->tipo == 'funcionario');

        Gate::define('aprobar-solicitud', function (User $user, solicitud $solicitud) {
            return $user->perfil()->tipo == 'funcionario';
        });

        Gate::define('aprobar-permiso-definitivo', function (User $user, solicitud $solicitud) {
            return $user->perfil()->tipo == 'funcionario';
        });

        Gate::define('asignar-numero', function (User $user, solicitud $solicitud) {

        });
    }
}
