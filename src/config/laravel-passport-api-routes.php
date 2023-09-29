<?php

use YurchenkoAndrew\LaravelPassportAPIRoutes\Models\User;

return [
    'app-url' => env('APP_URL', 'localhost'),
    'passport-client' => env('PASSPORT_CLIENT', 2),
    'passport-client-secret' => env('PASSPORT_CLIENT_SECRET'),

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => User::class,
        ],
    ],

];
