<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class AdminDashboardController extends Controller
{
    public function index(): void
    {
        $db = Database::getInstance();
        $stats = [
            'views30' => (int)$db->query("SELECT COUNT(*) c FROM page_views WHERE visited_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)")->fetch()['c'],
            'pages' => (int)$db->query("SELECT COUNT(*) c FROM pages")->fetch()['c'],
            'services' => (int)$db->query("SELECT COUNT(*) c FROM services")->fetch()['c'],
            'locations' => (int)$db->query("SELECT COUNT(*) c FROM locations")->fetch()['c'],
            'posts' => (int)$db->query("SELECT COUNT(*) c FROM blog_posts")->fetch()['c'],
            'latestLeads' => $db->query("SELECT * FROM contact_submissions ORDER BY id DESC LIMIT 5")->fetchAll(),
            'topPages' => $db->query("SELECT slug,COUNT(*) c FROM page_views GROUP BY slug ORDER BY c DESC LIMIT 10")->fetchAll(),
        ];
        $this->view('admin/dashboard/index', compact('stats'), 'admin');
    }
}
