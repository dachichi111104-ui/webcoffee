<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class Authenticate
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = $guards ?: ['web'];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return $next($request);
            }
        }

        // ❗ BẮT BUỘC trả Response
        return $this->unauthenticated($request);
    }

    protected function unauthenticated(Request $request): RedirectResponse
    {
        // ===== ADMIN =====
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->route('admin.login');
        }

        // ===== AJAX / FETCH (PUBLIC) =====
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        // ===== PUBLIC NORMAL =====
    return redirect('/')->with('auth', 1);
    }
}
