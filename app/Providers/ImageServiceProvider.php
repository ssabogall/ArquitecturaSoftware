<?php

/**
 * ImageServiceProvider
 *
 * Service Provider for image handling.
 *
 * @author Alejandro Carmona
 */

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Utils\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, function ($app) {
            return new ImageLocalStorage;
        });
    }

    public function boot(): void
    {
        //
    }
}
