<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class BlogController extends Controller
{
    public function index(): void
    {
        $db = Database::getInstance();
        $posts = $db->query("SELECT * FROM blog_posts WHERE status='published' ORDER BY published_at DESC")->fetchAll();
        $this->view('blog/index', compact('posts'));
    }

    public function show(array $params): void
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM blog_posts WHERE slug=:slug AND status='published' LIMIT 1");
        $stmt->execute(['slug' => $params['slug']]);
        $post = $stmt->fetch();
        if (!$post) { http_response_code(404); echo 'Inlägg saknas'; return; }
        $this->view('blog/show', compact('post'));
    }
}
