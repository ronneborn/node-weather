<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Models\Faq;

class AdminFaqController extends Controller
{
    public function index(): void
    {
        $faqs = (new Faq())->all();
        $this->view('admin/faqs/index', compact('faqs'), 'admin');
    }

    public function store(): void
    {
        if(!verify_csrf()) exit('csrf');
        (new Faq())->create($_POST);
        Response::redirect('/admin/faqs');
    }
}
