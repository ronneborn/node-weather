<?php
namespace App\Middleware;

use App\Core\Auth;
use App\Core\Middleware;
use App\Core\Request;
use App\Core\Response;

class AuthMiddleware implements Middleware
{
    public function handle(Request $request): void
    {
        if (!Auth::check()) {
            Response::redirect('/logga-in');
        }
    }
}
