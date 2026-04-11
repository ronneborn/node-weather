<?php

declare(strict_types=1);


namespace App\Core;


class View
{
    public static function render(string $view, array $data = [], string $layout = 'layouts/frontend'): void
    {
        $viewPath = dirname(__DIR__) . '/views/' . $view . '.php';
        $layoutPath = dirname(__DIR__) . '/views/' . $layout . '.php';

        if (!is_file($viewPath)) {
            throw new \RuntimeException("View saknas: {$view}");
        }

        extract($data, EXTR_SKIP);

        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        if (is_file($layoutPath)) {
            include $layoutPath;
            return;
        }

        echo $content;
    }
}
