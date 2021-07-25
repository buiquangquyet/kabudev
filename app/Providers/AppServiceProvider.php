<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->app->concord->registerModel(
            \Webkul\Product\Contracts\Product::class, \Kabu\Product\Models\Product::class
        );
        $this->app->concord->registerModel(
            \Webkul\Product\Contracts\ProductFlat::class, \Kabu\Product\Models\ProductFlat::class
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
