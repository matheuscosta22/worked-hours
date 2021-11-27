<?php

namespace App\Providers;

use App\Repositories\Contracts\DayWorkedInterface;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Repository\DayWorkedRepository;
use App\Repositories\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(DayWorkedInterface::class, DayWorkedRepository::class);
    }
}    