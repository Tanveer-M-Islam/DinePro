<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        try {
            $settings = null;
            if (\Illuminate\Support\Facades\Schema::hasTable('website_settings')) {
                $settings = \App\Models\WebsiteSetting::first();
            }
            // Share settings globally, even if null, to avoid undefined variable errors
            \Illuminate\Support\Facades\View::share('settings', $settings);
        } catch (\Exception $e) {
            // Failsafe for initial migration
             \Illuminate\Support\Facades\View::share('settings', null);
        }
    }
}
