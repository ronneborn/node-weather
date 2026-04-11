<?php
namespace App\Controllers;

class RobotsController
{
    public function index(): void
    {
        header('Content-Type: text/plain; charset=utf-8');
        $base = rtrim((require __DIR__ . '/../config/app.php')['base_url'], '/');
        echo "User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: {$base}/sitemap.xml\n";
    }
}
