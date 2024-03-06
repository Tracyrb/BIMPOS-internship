<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle($request, Closure $next)
    {

        if ($request->user() && $request->user()->hasRole('user')) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
