<?php

return [
    'client_id' => env(key: 'PAYPAL_CLIENT_ID'),
    'secret' => env(key: 'PAYPAL_SECRET'),

    'settings' => [
        'mode' => env(key: 'PAYPAL_MODE', default: 'sandbox'),
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path(path: '/logs/paypal.log'),
        'log.LogLevel' => 'ERROR'
    ]
    

];