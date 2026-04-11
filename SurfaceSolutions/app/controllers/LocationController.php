<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Location;

class LocationController extends Controller
{
    public function areas(): void
    {
        $locations = (new Location())->all('status = :status', ['status' => 'active']);
        $this->view('locations/index', compact('locations'));
    }

    public function show(array $params): void
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM locations WHERE slug = :slug AND status = :status LIMIT 1');
        $stmt->execute(['slug' => $params['location'], 'status' => 'active']);
        $location = $stmt->fetch();
        if (!$location) { http_response_code(404); echo 'Ort saknas'; return; }
        $this->view('locations/show', compact('location'));
    }
}
