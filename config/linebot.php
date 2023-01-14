<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Channel Access Token
    |--------------------------------------------------------------------------
    |
    | This value is the Line Bot channel access token.
    |
    */

    'channel_access_token' => env('LINE_BOT_CHANNEL_ACCESS_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Channel Secret
    |--------------------------------------------------------------------------
    |
    | This value is the Line Bot channel secret.
    |
    */

    'channel_secret' => env('LINE_BOT_CHANNEL_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Endpoint Base
    |--------------------------------------------------------------------------
    |
    | This value is the Line Bot API endpoint base URL.
    |
    */

    'endpoint_base' => env('LINE_BOT_ENDPOINT_BASE', 'https://api.line.me'),

    /*
    |--------------------------------------------------------------------------
    | Endpoint Base
    |--------------------------------------------------------------------------
    |
    | This value is the Line Bot API endpoint base URL.
    |
    */

    'data_endpoint_base' => env('LINE_BOT_DATA_ENDPOINT_BASE', 'https://api-data.line.me'),

    /*
    |--------------------------------------------------------------------------
    | Rich Menu
    |--------------------------------------------------------------------------
    |
    | This value is setting the Line Bot rich menu.
    | Use `php artisan linebot:richmenu:create "public/image.jpg"` to create
    | a new rich menu.
    |
    */

    'rich_menu' => [
        'size' => [
          'width' => 800,
          'height' => 270,
        ],
        'selected' => true,
        'name' => 'My first rich menu',
        'chatBarText' => '選單',
        'areas' => [
            [
                'bounds' => [
                    'x' => 0,
                    'y' => 0,
                    'width' => 400,
                    'height' => 270,
                ],
                'action' => [
                    'type' => 'uri',
                    'label' => 'Laravel',
                    'uri' => 'https://laravel.com/',
                ],
            ],
            [
                'bounds' => [
                    'x' => 400,
                    'y' => 0,
                    'width' => 400,
                    'height' => 270,
                ],
                'action' => [
                    'type' => 'uri',
                    'label' => 'Symfony',
                    'uri' => 'https://symfony.com/',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the Line Bot default cache driver name.
    |
    | Reference: "config/cache.php"
    | Supported: "apc", "array", "database", "file",
    |            "memcached", "redis", "dynamodb"
    |
    */

    'cache' => env('LINE_BOT_CACHE_DRIVER') ?? env('CACHE_DRIVER', 'file'),

    /*
    |--------------------------------------------------------------------------
    | Routes Path
    |--------------------------------------------------------------------------
    |
    | This value is the Line Bot routes file path.
    |
    */

    'routes_path' => 'routes/linebot.php',

    /*
    |--------------------------------------------------------------------------
    | User Eloquent Model
    |--------------------------------------------------------------------------
    |
    | This config is setting the Line Bot User Eloquent Model.
    |
    | (wip 功能開發中...)
    |
    */

    'user' => [
        'model' => App\User::class,
        'field' => 'line_user_id',
        'enabled' => false,
    ],

];
