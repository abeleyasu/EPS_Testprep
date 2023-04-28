<?php

return [
    'api_keys' => [
        'secret_key' => env('STRIPE_SECRET', null),
        'currency' => env('CASHIER_CURRENCY', 'USD'),
    ]
];