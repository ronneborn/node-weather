<?php
namespace App\Middleware;

use App\Core\Auth;
use App\Core\Middleware;
use App\Core\Request;

class WebsiteOwnershipMiddleware implements Middleware
{
    public function handle(Request $request): void
    {
        if (!Auth::check()) {
            http_response_code(401);
            exit('401');
        }
    }
}
