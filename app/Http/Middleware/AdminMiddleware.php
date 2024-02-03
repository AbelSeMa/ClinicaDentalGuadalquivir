<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->admin) {
            return $next($request);
        }

        abort(403, 'No tienes permisos de administrador.');

    }
}
