<?php
namespace App\Middleware;

use App\Core\Auth;
use App\Core\Response;

class AdminMiddleware
{
    public function handle(): void
    {
        if (!Auth::check()) {
            Response::redirect('/admin/login');
        }
    }
}
