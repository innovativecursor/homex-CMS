<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cloudinary;

class CloudinaryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Cloudinary::class, function ($app) {
            return \Cloudinary::config_from_url(env('CLOUDINARY_URL'));
        });
    }
}
