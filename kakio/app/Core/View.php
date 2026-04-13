<?php
namespace App\Core;

class View
{
    public static function render(string $view, array $data = [], string $layout = 'layouts/app'): void
    {
        extract($data);
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        $layoutFile = __DIR__ . '/../Views/' . $layout . '.php';

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;
    }
}
