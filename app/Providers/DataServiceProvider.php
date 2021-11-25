<?php

namespace App\Providers;

use App\Contracts\Services\DataServiceInterface;
use App\Services\DataService;
use Illuminate\Support\ServiceProvider;

class DataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(DataServiceInterface::class, DataService::class);
    }
}
