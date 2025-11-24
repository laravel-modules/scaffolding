<?php

use Laraeast\LaravelLocales\Enums\Language;

return [
    /*
    |--------------------------------------------------------------------------
    | Application Locales
    |--------------------------------------------------------------------------
    |
    | Contains the application's supported locales.
    |
    */
    'languages' => [
        Language::EN,
        Language::AR,
    ],

    'js' => [
        /*
        |--------------------------------------------------------------------------
        | Using javascript
        |--------------------------------------------------------------------------
        |
        | Generated locales file path for javascript when run "php artisan locales:generate-js"
        |
        */
        'file_path' => resource_path('/js/data/supported-locales.ts'),
    ],
];
