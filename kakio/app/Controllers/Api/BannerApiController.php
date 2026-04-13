<?php
namespace App\Controllers\Api;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\Database;
use App\Repositories\BannerRepository;
use App\Repositories\WebsiteRepository;

class BannerApiController extends Controller
{
    public function show(Request $request, string $siteKey): void
    {
        $website = (new WebsiteRepository())->findBySiteKey($siteKey);
        if (!$website || $website['status'] !== 'active') {
            Response::json(['error' => 'invalid_site_key'], 404);
            return;
        }

        $categories = Database::connection()->prepare('SELECT slug,label,required FROM cookie_categories WHERE website_id=:id ORDER BY id ASC');
        $categories->execute(['id' => $website['id']]);

        Response::json([
            'site' => ['domain' => $website['domain'], 'status' => $website['status']],
            'banner' => (new BannerRepository())->getByWebsite((int) $website['id']),
            'categories' => $categories->fetchAll(),
        ]);
    }
}
