<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class AdminStatisticsController extends Controller
{
    public function index(): void
    {
        $db = Database::getInstance();
        $stats = [
            'last7' => $db->query("SELECT slug,COUNT(*) c FROM page_views WHERE visited_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY slug ORDER BY c DESC LIMIT 20")->fetchAll(),
            'last30' => $db->query("SELECT slug,COUNT(*) c FROM page_views WHERE visited_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY slug ORDER BY c DESC LIMIT 20")->fetchAll(),
            'latest' => $db->query("SELECT slug,visited_at FROM page_views ORDER BY id DESC LIMIT 20")->fetchAll(),
        ];
        $this->view('admin/statistics/index', compact('stats'), 'admin');
    }
}
