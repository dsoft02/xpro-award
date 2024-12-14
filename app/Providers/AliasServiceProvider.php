<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AliasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Get the AliasLoader instance
        $loader = AliasLoader::getInstance();

        // Add your aliases
        $loader->alias('PDF', Barryvdh\Snappy\Facades\SnappyPdf::class);
        $loader->alias('SnappyImage', Barryvdh\Snappy\Facades\SnappyImage::class);
        $loader->alias('Image', Intervention\Image\Facades\Image::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
