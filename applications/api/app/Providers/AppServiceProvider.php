<?php

namespace App\Providers;

use App\Repositories\Fund\FundRepository;
use App\Repositories\Fund\FundRepositoryInterface;
use App\Services\Fund\FundService;
use App\Services\Fund\FundServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Fund
        $this->app->bind(FundServiceInterface::class, FundService::class);
        $this->app->bind(FundRepositoryInterface::class, FundRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
