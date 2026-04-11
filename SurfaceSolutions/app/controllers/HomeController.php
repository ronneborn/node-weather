<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Service;
use App\Models\Location;
use App\Models\BlogPost;

class HomeController extends Controller
{
    public function index(): void
    {
        $services = (new Service())->all('status = :status LIMIT 8', ['status' => 'active']);
        $locations = (new Location())->all('status = :status LIMIT 8', ['status' => 'active']);
        $posts = (new BlogPost())->all('status = :status LIMIT 3', ['status' => 'published']);
        $this->view('home/index', compact('services', 'locations', 'posts'));
    }
}
