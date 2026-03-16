<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentView::registerRenderHook(
            'panels::head.start',
            fn (): string => '<meta name="robots" content="noindex,nofollow">'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Policy
        Gate::policy(\Awcodes\Curator\Models\Media::class, \App\Policies\MediaPolicy::class);
        Gate::policy(\BezhanSalleh\FilamentExceptions\Models\Exception::class, \App\Policies\ExceptionPolicy::class);
        Gate::policy(\Croustibat\FilamentJobsMonitor\Models\QueueMonitor::class, \App\Policies\JobMonitorPolicy::class);
        \Illuminate\Support\Facades\Gate::policy(\Spatie\Activitylog\Models\Activity::class, \App\Policies\ActivityLogPolicy::class);

        Validator::extend('turnstile', function ($attribute, $value, $parameters, $validator) {
            $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => env('TURNSTILE_SECRET'),
                'response' => $value,
                'remoteip' => request()->ip(),
            ]);

            return $response->json('success');
        });

        Validator::replacer('turnstile', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Verifikasi keamanan gagal, silakan coba lagi.');
        });
    }
}
