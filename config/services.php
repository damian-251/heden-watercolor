<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'recaptcha' => [
        'public' => env('RECAPTCHA_PUBLIC'),
        'secret' => env('RECAPTCHA_SECRET')
    ],
    'stripe' => [
        'public' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET')
    ],
    'reservation' => [
        'minutes' => env('RESERVATION_TIME')
    ],
    'email' => [
        'admin' => env('ADMIN_EMAIL'),
        'request' => env('EMAIL_REQUEST')
    ],
    'shop' => [
        'disabled' => env('SHOP_DISABLED')
    ]
];
