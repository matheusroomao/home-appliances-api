<?php

namespace App\Providers;

use App\Repository\Contracts\BrandInterface;
use App\Repository\Contracts\ProductInterface;
use App\Repository\Eloquent\BrandRepository;
use App\Repository\Eloquent\ProductRepository;
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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(BrandInterface::class, BrandRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
    }
}
