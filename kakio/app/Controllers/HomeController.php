<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class HomeController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('home/index', ['title' => 'Svensk cookiehantering för småföretag']);
    }

    public function features(Request $request): void
    {
        $this->view('home/features', ['title' => 'Funktioner']);
    }

    public function pricing(Request $request): void
    {
        $this->view('pricing/index', ['title' => 'Priser']);
    }

    public function contact(Request $request): void
    {
        $this->view('home/contact', ['title' => 'Kontakt']);
    }
}
