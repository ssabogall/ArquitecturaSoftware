<?php

/**
 * ImageServiceProvider
 * 
 * Service Provider for image handling.
 * 
 * @author Alejandro Carmona
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\ImageStorage;
use App\Utils\ImageLocalStorage;

class ImageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImageStorage::class, function ($app) {
            return new ImageLocalStorage();
        });
    }

    public function boot(): void
    {
        //
    }
}