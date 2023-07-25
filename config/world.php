<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Supported locales.
    |--------------------------------------------------------------------------
    */
    'accepted_locales' => [
        'ar',
        'bn',
        'br',
        'de',
        'en',
        'es',
        'fr',
        'ja',
        'kr',
        'nl',
        'pl',
        'pt',
        'ro',
        'ru',
        'zh',
    ],
    /*
    |--------------------------------------------------------------------------
    | Enabled modules.
    | The cities module depends on the states module.
    |--------------------------------------------------------------------------
    */
    'modules' => [
        'languages'  => true,
    ],
    /*
    |--------------------------------------------------------------------------
    | Routes.
    |--------------------------------------------------------------------------
    */
    'routes' => false,
    /*
    |--------------------------------------------------------------------------
    | Migrations.
    |--------------------------------------------------------------------------
    */
    'migrations' => [
        'countries' => [
            'table_name'      => 'countries',
            'optional_fields' => [
                'phone_code' => [
                    'required' => true,
                    'type'     => 'string',
                    'length'   => 5,
                ],
                'iso3' => [
                    'required' => true,
                    'type'     => 'string',
                    'length'   => 3,
                ],
                'native' => [
                    'required' => false,
                    'type'     => 'string',
                ],
                'region' => [
                    'required' => true,
                    'type'     => 'string',
                ],
                'subregion' => [
                    'required' => true,
                    'type'     => 'string',
                ],
                'latitude' => [
                    'required' => false,
                    'type'     => 'string',
                ],
                'longitude' => [
                    'required' => false,
                    'type'     => 'string',
                ],
                'emoji' => [
                    'required' => false,
                    'type'     => 'string',
                ],
                'emojiU' => [
                    'required' => false,
                    'type'     => 'string',
                ],
            ],
        ],
        'languages' => [
            'table_name' => 'languages',
        ],
    ],
];
