<?php
namespace App\Middleware;

use App\Core\Auth;
use App\Core\Middleware;
use App\Core\Request;

class AdminMiddleware implements Middleware
{
    public function handle(Request $request): void
    {
        $user = Auth::user();
        if (!$user || ($user['role'] ?? 'customer') !== 'admin') {
            http_response_code(403);
            exit('403');
        }
    }
}
