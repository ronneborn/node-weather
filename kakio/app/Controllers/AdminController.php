<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Request;

class AdminController extends Controller
{
    public function index(Request $request): void
    {
        $db = Database::connection();
        $stats = [
            'users' => (int) $db->query('SELECT COUNT(*) FROM users')->fetchColumn(),
            'websites' => (int) $db->query('SELECT COUNT(*) FROM websites')->fetchColumn(),
            'subscriptions' => (int) $db->query("SELECT COUNT(*) FROM subscriptions WHERE status='active'")->fetchColumn(),
        ];
        $this->view('admin/index', ['title' => 'Admin', 'stats' => $stats]);
    }
}
