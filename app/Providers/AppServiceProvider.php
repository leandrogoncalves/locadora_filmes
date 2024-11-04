<?php

namespace App\Providers;

use App\Domain\Repository\CustomerRepositoryInterface;
use App\Domain\Repository\MovieRentalRepositoryInterface;
use App\Domain\Repository\MovieRepositoryInterface;
use App\Infrastructure\Repository\CustomerRepository;
use App\Infrastructure\Repository\MovieRentalRepository;
use App\Infrastructure\Repository\MovieRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );

        $this->app->bind(
            MovieRepositoryInterface::class,
            MovieRepository::class
        );
        $this->app->bind(
            MovieRentalRepositoryInterface::class,
            MovieRentalRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
