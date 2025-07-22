<?php

namespace App\Providers;

use App\Repositories\Implementations\MovieRepository;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Services\Implementations\MovieService;
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
