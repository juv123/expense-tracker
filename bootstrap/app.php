<?php

use Illuminate\Foundation\Application;

// Create the application
$app = new Application(
    realpath(__DIR__.'/../')
);

// Register the HTTP Kernel
$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

// Register the Console Kernel
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

// Register the service provider and middleware for the app
$app->withFacades();
$app->withEloquent();

// Return the application instance
return $app;
