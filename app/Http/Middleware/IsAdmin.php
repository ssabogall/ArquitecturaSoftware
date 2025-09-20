<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {

        if (! auth()->check() || ! auth()->user()->isStaff()) {
            abort(403, 'No autorizado.');
        }

        return $next($request);
    }
}
