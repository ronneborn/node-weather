<?php
use App\Controllers\{HomeController,PageController,ServiceController,LocationController,BlogController,ContactController,SitemapController,RobotsController,AdminAuthController,AdminDashboardController,AdminPageController,AdminServiceController,AdminLocationController,AdminServiceLocationPageController,AdminBlogController,AdminFaqController,AdminLeadController,AdminMediaController,AdminRedirectController,AdminSettingsController,AdminStatisticsController};
use App\Middleware\AdminMiddleware;

$router->get('/', [HomeController::class, 'index']);
$router->get('/om-oss', [PageController::class, 'about']);
$router->get('/kontakt', [ContactController::class, 'index']);
$router->post('/kontakt', [ContactController::class, 'submit']);
$router->get('/tjanster', [ServiceController::class, 'index']);
$router->get('/omraden', [LocationController::class, 'areas']);
$router->get('/blogg', [BlogController::class, 'index']);
$router->get('/blogg/{slug}', [BlogController::class, 'show']);
$router->get('/faq', [PageController::class, 'faq']);
$router->get('/integritetspolicy', [PageController::class, 'privacy']);
$router->get('/sitemap.xml', [SitemapController::class, 'index']);
$router->get('/robots.txt', [RobotsController::class, 'index']);
$router->get('/{location}', [LocationController::class, 'show']);
$router->get('/{service}-{location}', [ServiceController::class, 'showLocal']);

$router->get('/admin/login', [AdminAuthController::class, 'showLogin']);
$router->post('/admin/login', [AdminAuthController::class, 'login']);
$router->get('/admin/logout', [AdminAuthController::class, 'logout']);

$admin = [AdminMiddleware::class];
$router->get('/admin', [AdminDashboardController::class, 'index'], $admin);
$router->get('/admin/pages', [AdminPageController::class, 'index'], $admin);
$router->get('/admin/pages/create', [AdminPageController::class, 'create'], $admin);
$router->post('/admin/pages/create', [AdminPageController::class, 'store'], $admin);
$router->get('/admin/pages/edit/{id}', [AdminPageController::class, 'edit'], $admin);
$router->post('/admin/pages/edit/{id}', [AdminPageController::class, 'update'], $admin);
$router->post('/admin/pages/delete/{id}', [AdminPageController::class, 'delete'], $admin);
$router->post('/admin/pages/duplicate/{id}', [AdminPageController::class, 'duplicate'], $admin);

$router->get('/admin/services', [AdminServiceController::class, 'index'], $admin);
$router->get('/admin/services/create', [AdminServiceController::class, 'create'], $admin);
$router->post('/admin/services/create', [AdminServiceController::class, 'store'], $admin);
$router->get('/admin/services/edit/{id}', [AdminServiceController::class, 'edit'], $admin);
$router->post('/admin/services/edit/{id}', [AdminServiceController::class, 'update'], $admin);

$router->get('/admin/locations', [AdminLocationController::class, 'index'], $admin);
$router->get('/admin/locations/create', [AdminLocationController::class, 'create'], $admin);
$router->post('/admin/locations/create', [AdminLocationController::class, 'store'], $admin);
$router->get('/admin/locations/edit/{id}', [AdminLocationController::class, 'edit'], $admin);
$router->post('/admin/locations/edit/{id}', [AdminLocationController::class, 'update'], $admin);

$router->get('/admin/service-location-pages', [AdminServiceLocationPageController::class, 'index'], $admin);
$router->get('/admin/service-location-pages/create', [AdminServiceLocationPageController::class, 'create'], $admin);
$router->post('/admin/service-location-pages/create', [AdminServiceLocationPageController::class, 'store'], $admin);
$router->get('/admin/service-location-pages/edit/{id}', [AdminServiceLocationPageController::class, 'edit'], $admin);
$router->post('/admin/service-location-pages/edit/{id}', [AdminServiceLocationPageController::class, 'update'], $admin);
$router->post('/admin/service-location-pages/generate', [AdminServiceLocationPageController::class, 'generate'], $admin);

$router->get('/admin/blog', [AdminBlogController::class, 'index'], $admin);
$router->get('/admin/blog/create', [AdminBlogController::class, 'create'], $admin);
$router->post('/admin/blog/create', [AdminBlogController::class, 'store'], $admin);
$router->get('/admin/blog/edit/{id}', [AdminBlogController::class, 'edit'], $admin);
$router->post('/admin/blog/edit/{id}', [AdminBlogController::class, 'update'], $admin);

$router->get('/admin/faqs', [AdminFaqController::class, 'index'], $admin);
$router->post('/admin/faqs', [AdminFaqController::class, 'store'], $admin);
$router->get('/admin/leads', [AdminLeadController::class, 'index'], $admin);
$router->get('/admin/leads/export', [AdminLeadController::class, 'exportCsv'], $admin);
$router->get('/admin/media', [AdminMediaController::class, 'index'], $admin);
$router->post('/admin/media', [AdminMediaController::class, 'upload'], $admin);
$router->get('/admin/redirects', [AdminRedirectController::class, 'index'], $admin);
$router->post('/admin/redirects', [AdminRedirectController::class, 'store'], $admin);
$router->get('/admin/settings', [AdminSettingsController::class, 'index'], $admin);
$router->post('/admin/settings', [AdminSettingsController::class, 'save'], $admin);
$router->get('/admin/statistics', [AdminStatisticsController::class, 'index'], $admin);
