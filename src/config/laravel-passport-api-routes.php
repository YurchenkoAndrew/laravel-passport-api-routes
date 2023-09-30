<?php

use YurchenkoAndrew\LaravelPassportAPIRoutes\Models\User;

return [
    'app-url' => env('APP_URL', 'http://localhost'),
    'app-front-url' => env('APP_FRONT_URL', 'http://localhost:4200'),
    'after-register-email-confirmation-route' => env('AFTER_REGISTER_EMAIL_CONFIRMATION_ROUTE', '/auth/login?verified=true'),
    'passport-client' => env('PASSPORT_CLIENT', 2),
    'passport-client-secret' => env('PASSPORT_CLIENT_SECRET'),

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => User::class,
        ],
    ],

];
