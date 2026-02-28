<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // kalau belum login -> biarkan auth middleware yang handle
        if (!$user) {
            return redirect()->route('login');
        }

        // kalau bukan admin -> lempar ke produk
        if (!method_exists($user, 'isAdmin') || !$user->isAdmin()) {
            return redirect()->route('produk.index');
        }

        return $next($request);
    }
}