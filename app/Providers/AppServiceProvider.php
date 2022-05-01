<?php

namespace App\Providers;

use App\Models\{Empresas,Parametros};
use App\Observers\Empresas\EmpresasObserver;
use App\Observers\Parametros\ParametrosObserver;
use App\Repository\{EmpresasRepository,ParametrosRepository};
use App\Repository\Interfaces\{EmpresasRepositoryInterface,ParametrosRepositoryInterface};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ParametrosRepositoryInterface::class, ParametrosRepository::class);
        $this->app->bind(EmpresasRepositoryInterface::class, EmpresasRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Parametros::observe(ParametrosObserver::class);
        Empresas::observe(EmpresasObserver::class);
    }
}
