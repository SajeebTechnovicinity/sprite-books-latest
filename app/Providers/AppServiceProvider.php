<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Author;
use App\Models\Setting;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Cashier::useCustomerModel(Author::class);

        view()->composer(
            '*',
            function ($view) {
                $view->with(['globalSetting' => Setting::first(),]);
            }
        );

    }
}
