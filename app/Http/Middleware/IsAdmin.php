<?php

/**
 * Middleware/IsAdmin.php
 *
 * Middleware to verify if the user is an administrator.
 *
 * @author Alejandro Carmona
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || ! auth()->user()->isStaff()) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}