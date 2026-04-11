<?php
namespace App\Controllers;

use App\Core\Controller;

class PageController extends Controller
{
    public function about(): void { $this->view('pages/about'); }
    public function faq(): void { $this->view('pages/faq'); }
    public function privacy(): void { $this->view('pages/privacy'); }
}
