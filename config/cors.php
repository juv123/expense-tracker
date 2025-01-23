<?php

return [
    'supports_credentials' => true,

    'allowed_origins' => ['http://localhost:3000'],  // Your frontend URL
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'allowed_methods' => ['*'],
    'allowed_headers' => ['*', 'X-Requested-With'],
    'max_age' => 0,
    'hosts' => [],
];