<?php

namespace App\Providers;

use App\Repositories\Implementations\AuthRepository;
use App\Repositories\Implementations\MovieRepository;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Services\Implementations\AuthService;
use App\Services\Implementations\MovieService;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\MovieServiceInterface;
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
        $this->app->bind(MovieRepositoryInterface::class, MovieRepository::class);
        $this->app->bind(MovieServiceInterface::class, MovieService::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
