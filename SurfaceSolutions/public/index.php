<?php
require __DIR__ . '/../app/helpers/text_helper.php';
require __DIR__ . '/../app/helpers/url_helper.php';
require __DIR__ . '/../app/helpers/csrf_helper.php';
require __DIR__ . '/../app/helpers/slug_helper.php';
require __DIR__ . '/../app/helpers/seo_helper.php';
require __DIR__ . '/../app/helpers/schema_helper.php';
require __DIR__ . '/../app/helpers/stats_helper.php';

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) return;
    $relative = str_replace('App\\', '', $class);
    $relative = str_replace('\\', '/', $relative);
    $file = __DIR__ . '/../app/' . strtolower(dirname($relative)) . '/' . basename($relative) . '.php';
    if (file_exists($file)) require $file;
});

date_default_timezone_set('Europe/Stockholm');
App\Core\Session::start();

$request = new App\Core\Request();
$path = $request->uri();

$db = App\Core\Database::getInstance();
$r = $db->prepare('SELECT new_path,status_code FROM redirects WHERE old_path = :p LIMIT 1');
$r->execute(['p' => $path]);
if ($row = $r->fetch()) {
    http_response_code((int)$row['status_code']);
    header('Location: ' . $row['new_path']);
    exit;
}

$router = new App\Core\Router();
require __DIR__ . '/../app/config/routes.php';
$router->dispatch($request);
