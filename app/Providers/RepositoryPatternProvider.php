<?php

namespace App\Providers;

use App\Repository\Auth\AuthRepository;
use App\Repository\Auth\AuthRepositoryImpl;
use App\Repository\WasteBank\WasteBankRepository;
use App\Repository\WasteBank\WasteBankRepositoryImpl;
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
        $this->app->singleton(WasteBankRepository::class, function() {
            return new WasteBankRepositoryImpl();
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
