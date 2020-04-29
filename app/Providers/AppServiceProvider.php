<?php

namespace App\Providers;

use App\Repositories\StatRepository;
use App\Repositories\StatRepositoryInterface;
use App\Services\StatService;
use App\Services\StatServiceInterface;
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
        $this->app->bind(StatServiceInterface::class,StatService::class);
        $this->app->bind(StatRepositoryInterface::class,StatRepository::class);
    }
}
