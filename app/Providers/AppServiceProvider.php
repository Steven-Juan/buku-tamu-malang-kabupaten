<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentView::registerRenderHook(
            'panels::head.start',
            fn(): string => '<meta name="robots" content="noindex,nofollow">'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Daftarkan Policy secara manual di sini
        Gate::policy(\Awcodes\Curator\Models\Media::class, \App\Policies\MediaPolicy::class);
        Gate::policy(\BezhanSalleh\FilamentExceptions\Models\Exception::class, \App\Policies\ExceptionPolicy::class);
        Gate::policy(\Croustibat\FilamentJobsMonitor\Models\QueueMonitor::class, \App\Policies\JobMonitorPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\Spatie\Activitylog\Models\Activity::class, \App\Policies\ActivityLogPolicy::class);
    }
}
