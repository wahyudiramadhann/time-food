<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user()->role !== $role) {
            if ($request->user()->role === 'restaurant') {
                return redirect()->route('dashboard');
            }
            return redirect()->route('menu.index');
        }

        return $next($request);
    }
}