<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            $locale = session('app_locale') ?: (request()->cookie('app_locale') ?: config('app.locale'));
        } catch (\Exception $e) {
            $locale = config('app.locale');
        }

        if ($locale) {
            app()->setLocale($locale);
        }

        View::composer('*', function () {
            try {
                $locale = session('app_locale') ?: (request()->cookie('app_locale') ?: config('app.locale'));
            } catch (\Exception $e) {
                $locale = config('app.locale');
            }

            if ($locale) {
                app()->setLocale($locale);
            }
        });
    }
}
