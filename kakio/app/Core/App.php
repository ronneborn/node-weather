<?php
namespace App\Core;

class App
{
    public function run(): void
    {
        Session::start();
        $router = new Router();

        require __DIR__ . '/../../routes/web.php';
        require __DIR__ . '/../../routes/admin.php';
        require __DIR__ . '/../../routes/api.php';

        $router->dispatch(new Request());
    }
}
