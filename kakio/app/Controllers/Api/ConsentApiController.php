<?php
namespace App\Controllers\Api;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Repositories\WebsiteRepository;
use App\Services\ConsentService;

class ConsentApiController extends Controller
{
    public function store(Request $request, string $siteKey): void
    {
        $website = (new WebsiteRepository())->findBySiteKey($siteKey);
        if (!$website) {
            Response::json(['error' => 'invalid_site_key'], 404);
            return;
        }

        $payload = $request->json();
        if (empty($payload['consent_uuid']) || empty($payload['consents']) || !is_array($payload['consents'])) {
            Response::json(['error' => 'invalid_payload'], 422);
            return;
        }

        (new ConsentService())->store((int) $website['id'], $payload);
        Response::json(['status' => 'ok']);
    }
}
