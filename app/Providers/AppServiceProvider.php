<?php

namespace App\Providers;

use App\Models\{Parameters, User,};
use App\Observers\Parameters\ParametersObserver;
use App\Observers\Users\UsersObserver;
use App\Repositories\Contracts\{
    UsersRepositoryInterface,
    ParametersRepositoryInterface,
    ItemSubItemsInterface,
    MenuItemsInterface,
    MenusInterface,
};
use App\Repositories\Eloquent\{
    UsersRepository,
    ParametersRepository,
    ItemSubItemsRepository,
    MenuItemsRepository,
    MenusRepository,
};
use Illuminate\Pagination\Paginator;
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
        $this->app->bind(ParametersRepositoryInterface::class, ParametersRepository::class);
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
        $this->app->bind(MenusInterface::class, MenusRepository::class);
        $this->app->bind(MenuItemsInterface::class, MenuItemsRepository::class);
        $this->app->bind(ItemSubItemsInterface::class, ItemSubItemsRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        Parameters::observe(ParametersObserver::class);
        User::observe(UsersObserver::class);
    }
}
