<?php
namespace App\Controllers;

use App\Core\Database;

class SitemapController
{
    public function index(): void
    {
        header('Content-Type: application/xml; charset=utf-8');
        $base = rtrim((require __DIR__ . '/../config/app.php')['base_url'], '/');
        $db = Database::getInstance();
        $urls = ['/','/om-oss','/kontakt','/tjanster','/omraden','/blogg','/faq'];
        foreach ($db->query("SELECT slug FROM blog_posts WHERE status='published'")->fetchAll() as $p) $urls[]='/blogg/'.$p['slug'];
        foreach ($db->query("SELECT slug FROM locations WHERE status='active'")->fetchAll() as $l) $urls[]='/'.$l['slug'];
        foreach ($db->query("SELECT slug FROM service_location_pages WHERE status='published'")->fetchAll() as $s) $urls[]='/'.$s['slug'];
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
        foreach ($urls as $url) echo '<url><loc>'.$base.$url.'</loc></url>';
        echo '</urlset>';
    }
}
