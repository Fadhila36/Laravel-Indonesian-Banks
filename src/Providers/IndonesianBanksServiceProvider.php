<?php

declare(strict_types=1);

namespace Fadhila36\IndonesianBanks\Providers;

use Fadhila36\IndonesianBanks\Services\BankService;
use Fadhila36\IndonesianBanks\Repositories\BankRepository;
use Illuminate\Support\ServiceProvider;

class IndonesianBanksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/indonesian-banks.php', 'indonesian-banks'
        );

        $this->app->bind(
            \Fadhila36\IndonesianBanks\Contracts\BankRepositoryInterface::class,
            \Fadhila36\IndonesianBanks\Repositories\BankRepository::class
        );

        $this->app->singleton('indonesian-bank', function ($app) {
            return new BankService($app->make(\Fadhila36\IndonesianBanks\Contracts\BankRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/indonesian-banks.php' => config_path('indonesian-banks.php'),
            ], 'indonesian-banks-config');

            $this->publishes([
                __DIR__.'/../../src/database/migrations/' => database_path('migrations'),
            ], 'indonesian-banks-migrations');
        }
    }
}
