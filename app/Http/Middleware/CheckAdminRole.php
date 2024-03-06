<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        dd($request->user());
        if ($request->user()->hasRole('admin')) {
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
