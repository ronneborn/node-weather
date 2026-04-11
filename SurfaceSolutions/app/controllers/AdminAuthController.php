<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Response;

class AdminAuthController extends Controller
{
    public function showLogin(): void
    {
        $this->view('admin/auth/login', [], 'admin');
    }

    public function login(): void
    {
        if (!verify_csrf()) { exit('CSRF-fel'); }
        if (Auth::attempt($_POST['email'] ?? '', $_POST['password'] ?? '')) {
            Response::redirect('/admin');
        }
        $this->view('admin/auth/login', ['error' => 'Fel e-post eller lösenord'], 'admin');
    }

    public function logout(): void
    {
        Auth::logout();
        Response::redirect('/admin/login');
    }
}
