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
        try {
            // Use a view composer or simply share if table exists
            if (\Illuminate\Support\Facades\Schema::hasTable('website_settings')) {
                $settings = \App\Models\WebsiteSetting::first();
                // If no settings exist yet (fresh install), use defaults or null
                \Illuminate\Support\Facades\View::share('settings', $settings);
            }
        } catch (\Exception $e) {
            // Failsafe for initial migration
        }
    }
}
