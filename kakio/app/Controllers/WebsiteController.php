<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Csrf;
use App\Core\Database;
use App\Core\Request;
use App\Repositories\BannerRepository;
use App\Repositories\ConsentRepository;
use App\Repositories\ScanRepository;
use App\Repositories\WebsiteRepository;
use App\Services\BannerService;
use App\Services\DomainService;
use App\Services\SiteKeyService;

class WebsiteController extends Controller
{
    public function index(Request $request): void
    {
        $sites = (new WebsiteRepository())->listByUser((int) Auth::user()['id']);
        $this->view('websites/index', ['title' => 'Mina webbplatser', 'websites' => $sites]);
    }

    public function create(Request $request): void
    {
        $this->view('websites/create', ['title' => 'Ny webbplats']);
    }

    public function store(Request $request): void
    {
        if (!Csrf::verify($request->input('_csrf'))) { http_response_code(419); exit('CSRF'); }
        $domain = (new DomainService())->normalize((string) $request->input('domain'));
        $siteId = (new WebsiteRepository())->create([
            'user_id' => Auth::user()['id'],
            'domain' => $domain,
            'site_key' => (new SiteKeyService())->generate(),
            'status' => 'active',
        ]);

        Database::connection()->prepare("INSERT INTO banner_settings (website_id,title,body,accept_text,deny_text,preferences_text,position,primary_color,revision,created_at,updated_at) VALUES (:website_id,'Vi använder cookies','Vi använder cookies för statistik och förbättringar.','Acceptera alla','Neka alla','Anpassa val','bottom','#1d4ed8',1,NOW(),NOW())")
            ->execute(['website_id' => $siteId]);
        Database::connection()->prepare("INSERT INTO cookie_categories (website_id,slug,label,required,created_at) VALUES (:w,'necessary','Nödvändiga',1,NOW()),(:w,'statistics','Statistik',0,NOW()),(:w,'marketing','Marknadsföring',0,NOW()),(:w,'functional','Funktionella',0,NOW()),(:w,'uncategorized','Okategoriserade',0,NOW())")
            ->execute(['w' => $siteId]);

        $this->redirect('/app/webbplatser/' . $siteId);
    }

    public function show(Request $request, string $id): void
    {
        $site = (new WebsiteRepository())->findOwned((int) $id, (int) Auth::user()['id']);
        if (!$site) { http_response_code(404); exit('Not found'); }

        $this->view('websites/show', [
            'title' => 'Webbplats',
            'site' => $site,
            'banner' => (new BannerRepository())->getByWebsite((int) $id),
            'consents' => (new ConsentRepository())->latestByWebsite((int) $id, 20),
            'scans' => (new ScanRepository())->byWebsite((int) $id),
        ]);
    }

    public function saveBanner(Request $request, string $id): void
    {
        if (!Csrf::verify($request->input('_csrf'))) { http_response_code(419); exit('CSRF'); }
        (new BannerService())->save((int) $id, $_POST);
        $this->redirect('/app/webbplatser/' . (int) $id . '/banner');
    }

    public function queueScan(Request $request, string $id): void
    {
        if (!Csrf::verify($request->input('_csrf'))) { http_response_code(419); exit('CSRF'); }
        (new ScanRepository())->queue((int) $id);
        $this->redirect('/app/webbplatser/' . (int) $id . '/scans');
    }
}
