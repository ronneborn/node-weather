<?php
return [
    'name' => $_ENV['APP_NAME'] ?? 'Kakio',
    'env' => $_ENV['APP_ENV'] ?? 'production',
    'debug' => ($_ENV['APP_DEBUG'] ?? 'false') === 'true',
    'url' => $_ENV['APP_URL'] ?? 'http://localhost',
    'session_name' => $_ENV['SESSION_NAME'] ?? 'kakio_session',
    'session_secure_cookie' => ($_ENV['SESSION_SECURE_COOKIE'] ?? 'true') === 'true',
];
