<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Jobs\WPSync;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(100);
        Relation::enforceMorphMap([
            'App\Models\User'               => 'App\Models\User',
            'App\Models\AccountApplication' => 'App\Models\AccountApplication',
        ]);
        $this->app->bindMethod([WPSync::class, 'handle'], function (WPSync $job, Application $app) {
            return $job->handle();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Implicitly grant "Super-Admin" role all permission checks using can()
        Gate::after(function ($user, $ability) {
        });
    }
}
