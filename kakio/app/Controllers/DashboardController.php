<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Request;
use App\Repositories\WebsiteRepository;

class DashboardController extends Controller
{
    public function index(Request $request): void
    {
        $user = Auth::user();
        $sites = (new WebsiteRepository())->listByUser((int) $user['id']);
        $this->view('dashboard/index', [
            'title' => 'Dashboard',
            'websites' => $sites,
            'user' => $user,
        ]);
    }
}
