<?php
namespace App\Controllers\Api;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Request;
use App\Core\Response;
use App\Repositories\WebsiteRepository;

class ScanApiController extends Controller
{
    public function result(Request $request, string $siteKey): void
    {
        $website = (new WebsiteRepository())->findBySiteKey($siteKey);
        if (!$website) {
            Response::json(['error' => 'invalid_site_key'], 404);
            return;
        }

        $stmt = Database::connection()->prepare('SELECT * FROM scans WHERE website_id=:website_id ORDER BY id DESC LIMIT 1');
        $stmt->execute(['website_id' => $website['id']]);
        Response::json(['scan' => $stmt->fetch()]);
    }

    public function health(Request $request): void
    {
        Response::json(['status' => 'ok', 'service' => 'kakio-api']);
    }
}
