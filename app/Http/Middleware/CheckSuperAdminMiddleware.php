<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;

class CheckSuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(session()->get('level') === 0){
            throw new Exception('No permission to delete');
        }
        return $next($request);
    }
}
