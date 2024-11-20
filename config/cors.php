<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],


    'allowed_origins' => ['http://localhost:5173', 'https://collormixstore.com', 'https://www.collormixstore.com', 'https://manager.santaritahomecenter.com', ],


    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Content-Type', 'Authorization'],

    'exposed_headers' => [],

    'max_age' => 86400, // 1 dia

    'supports_credentials' => true, // se necessário
];

