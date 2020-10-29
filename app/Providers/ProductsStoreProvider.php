<?php

namespace App\Providers;

use App\Http\Requests\ProductStoreRequestHandler;
use App\Service\ProductStore;
use Illuminate\Support\ServiceProvider;

/**
 * It's registering all services to process ProductStore.
 */
class ProductsStoreProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ProductStore::class, function($app) {
            return new ProductStore();
        });
        $this->app->singleton(ProductStoreRequestHandler::class, function($app) {
            return new ProductStoreRequestHandler();
        });
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
