<?php

return [
    'min_withdraw' => env('MIN_WITHDRAW', 10000),

    'lnbits'       => [
        'url'           => env('ADMIN_LNBITS_URL'),
        'admin_api_key' => env('ADMIN_LNBITS_API_KEY'),
    ],
    'btcpayserver' => [
        'url'           => env('ADMIN_BTCPAYSERVER_URL'),
        'admin_api_key' => env('ADMIN_BTCPAYSERVER_API_KEY'),
    ]
];
