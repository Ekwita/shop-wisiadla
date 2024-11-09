<?php

namespace App\Providers;

use App\Repositories\CartRepository;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Services\CartService;
use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
