<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Models\Redirect;

class AdminRedirectController extends Controller
{
    public function index(): void { $redirects = (new Redirect())->all(); $this->view('admin/redirects/index', compact('redirects'),'admin'); }
    public function store(): void { if(!verify_csrf()) exit('csrf'); (new Redirect())->create($_POST + ['status_code'=>301]); Response::redirect('/admin/redirects'); }
}
