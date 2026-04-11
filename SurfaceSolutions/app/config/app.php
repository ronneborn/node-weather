<?php
return [
    'name' => 'SurfaceSolutions',
    'base_url' => getenv('APP_URL') ?: 'http://localhost',
    'env' => getenv('APP_ENV') ?: 'production',
    'debug' => (bool)(getenv('APP_DEBUG') ?: false),
    'timezone' => 'Europe/Stockholm',
    'uploads_path' => __DIR__ . '/../../public/uploads',
    'csrf_key' => 'csrf_token',
];
