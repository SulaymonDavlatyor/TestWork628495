<?php

namespace App\Providers;

use App\Interfaces\GenreRepositoryInterface;
use App\Interfaces\MovieRepositoryInterface;
use App\Repositories\MovieRepository;
use App\Repositories\GenreRepository;
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
        $this->app->bind(GenreRepositoryInterface::class, GenreRepository::class);
        $this->app->bind(MovieRepositoryInterface::class, MovieRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
