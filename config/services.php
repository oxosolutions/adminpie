<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'github' => [
        'client_id' => '3144bc67aecb5f4e13d4',         // Your GitHub Client ID
        'client_secret' => '806258168f4365cf33ee3cef5a1cb5e0044f3acd', // Your GitHub Client Secret
        'redirect' => 'http://admin.scolm.com/handlecallback/github',
    ],

    'facebook' => [
        'client_id'     => '1911702689150339',
        'client_secret' => '4df58532b65c517cc6b4fbc332713c08',
        'redirect'      => 'http://admin.scolm.com/handlecallback/facebook',
    ],

];
