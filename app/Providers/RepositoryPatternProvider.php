<?php

namespace App\Providers;

use App\Repository\Auth\AuthRepository;
use App\Repository\Auth\AuthRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryPatternProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthRepository::class, function() {
            return new AuthRepositoryImpl();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public function provides()
    {
        return [AuthRepository::class];
    }
}
