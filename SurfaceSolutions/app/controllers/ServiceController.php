<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(): void
    {
        $services = (new Service())->all('status = :status', ['status' => 'active']);
        $this->view('services/index', compact('services'));
    }

    public function showLocal(array $params): void
    {
        $slug = $params['service'] . '-' . $params['location'];
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM service_location_pages WHERE slug = :slug AND status = :status LIMIT 1');
        $stmt->execute(['slug' => $slug, 'status' => 'published']);
        $page = $stmt->fetch();
        if (!$page) { http_response_code(404); echo 'Sidan saknas'; return; }
        $this->view('services/local', compact('page'));
    }
}
