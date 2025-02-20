<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'], // Permite que qualquer origem acesse a API (para ambientes de desenvolvimento)

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Permite todos os headers nas requisições

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Permite envio de cookies (caso necessário)
];
